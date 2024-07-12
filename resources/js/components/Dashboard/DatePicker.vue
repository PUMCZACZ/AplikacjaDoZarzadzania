<script setup>
import {ref} from "vue";

const props = defineProps({
    label: String,
});

const date = ref(new Date().toLocaleDateString('en-ca'));

const emits = defineEmits(['changeDate']);

const changeDate = (event) => {
    emits('changeDate', event.target.value);
};
</script>

<template>
    <div class="col-6">
        <div class="surface-card shadow-2 p-3 border-round">
            <div>
                <span class="block text-500 font-medium mb-3">{{ label }}</span>
                <div class="text-900 font-medium text-xl">
                    <Calendar v-model="date" @change="changeDate" dateFormat="yy/mm/dd"/>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
