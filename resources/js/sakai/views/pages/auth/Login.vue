<script setup>
import { useLayout } from '@sakai/layout/composables/layout.js';
import { ref, computed } from 'vue';
import AppConfig from '@sakai/layout/AppConfig.vue';

const { layoutConfig } = useLayout();
const redirectRoute = '/dashboard';

const email = ref();
const password = ref();
const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content')

const errors = ref();

const props = defineProps({
    form_route: String,
});


function sendLoginForm() {
    axios.post(props.form_route, {
        email: email._value,
        password: password._value,
        _token: csrf,
    }).then(res => {
        window.location.href = redirectRoute;
    }).catch(res => {
        errors.value = res.response.data.errors;
    });
}


</script>

<template>
    <div class="surface-ground flex align-items-center justify-content-center min-h-screen min-w-screen overflow-hidden">
        <div class="flex flex-column align-items-center justify-content-center">
            <div style="border-radius: 56px; padding: 0.3rem; background: linear-gradient(180deg, var(--primary-color) 10%, rgba(33, 150, 243, 0) 30%)">
                <div class="w-full surface-card py-8 px-5 sm:px-8" style="border-radius: 53px">
                    <div class="text-center mb-5">
                        <div class="text-900 text-3xl font-medium mb-3">Witamy Ponownie!</div>
                        <span class="text-600 font-medium">Zaloguj się aby kontynuować</span>
                    </div>
                    <div>
                        <form :action="form_route" method="POST">
                            <input type="hidden" name="_token" :value="csrf" />

                                <label for="email" class="block text-900 text-xl font-medium mb-2">Email</label>
                                <InputText id="email" v-model="email" type="text" placeholder="Email address" class="w-full md:w-30rem mb-3" style="padding: 1rem" />
                                <p v-if="errors?.email" class="text-red-500 mb-2">{{ errors.email[0] }}</p>


                            <label for="password" class="block text-900 font-medium text-xl mb-2">Password</label>
                            <Password id="password" v-model="password" placeholder="Password" class="w-full mb-3" inputClass="w-full" :inputStyle="{ padding: '1rem' }"></Password>
                            <p v-if="errors?.password" class="text-red-500">{{ errors.password[0] }}</p>

                            <Button @click="sendLoginForm()" label="Sign In" class="w-full p-3 text-xl"></Button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <AppConfig simple />
</template>

<style scoped>
.pi-eye {
    transform: scale(1.6);
    margin-right: 1rem;
}

.pi-eye-slash {
    transform: scale(1.6);
    margin-right: 1rem;
}
</style>
