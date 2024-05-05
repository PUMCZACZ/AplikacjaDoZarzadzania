<script setup>
import Dropdown from 'primevue/dropdown';
import {ref} from "vue";

const selected_value = ref('bag');

const props = defineProps({
    options: JSON,
})
</script>

<template>
    <Dropdown v-model="selected_value" :options="options" optionLabel="name" option-value="value"></Dropdown>
</template>

<style scoped>

</style>
