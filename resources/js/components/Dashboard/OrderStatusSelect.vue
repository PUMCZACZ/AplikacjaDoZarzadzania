<script setup>
import Dropdown from 'primevue/dropdown';
import {ref} from "vue";

const selectedValue = ref('realised');

const orderStatuses = ref([
    { name: 'Zrealizowane', value: 'realised' },
    { name: 'Nie zrealizowane', value: 'no realised' },
]);

const emits = defineEmits(['changeOrderStatusSelect']);

const handleChange = (event) => {
    console.log(event)
    emits('changeOrderStatusSelect', event.value);
};
</script>

<template>
    <Dropdown v-model="selectedValue" :options="orderStatuses" optionLabel="name"
              option-value="value" @change="handleChange"></Dropdown>
</template>

<style scoped>

</style>
