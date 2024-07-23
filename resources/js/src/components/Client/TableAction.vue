<script setup>
import Dialog from 'primevue/dialog';
import {ref} from "vue";
const displayDeleteDialog = ref(false);

const deleteConfirm = () => {
    console.log(1)
};
</script>

<template>
    <button @click="displayDeleteDialog = true">XD</button>
    <Dialog :visible="displayDeleteDialog" header="Header" >
        <span class="p-text-secondary block mb-5">Update your information.</span>
        <div class="flex align-items-center gap-3 mb-3">
            <label for="username" class="font-semibold w-6rem">Username</label>
            <InputText id="username" class="flex-auto" autocomplete="off" />
        </div>
        <div class="flex align-items-center gap-3 mb-5">
            <label for="email" class="font-semibold w-6rem">Email</label>
            <InputText id="email" class="flex-auto" autocomplete="off" />
        </div>
        <div class="flex justify-content-end gap-2">
            <Button type="button" label="Cancel" severity="secondary" @click="displayDeleteDialog = false"></Button>
            <Button type="button" label="Save" @click="displayDeleteDialog = false"></Button>
        </div>
    </Dialog>
</template>

<style scoped lang="scss">

</style>
