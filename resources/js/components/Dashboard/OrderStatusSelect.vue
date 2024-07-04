<script setup>
import Dropdown from 'primevue/dropdown';
import {ref, inject} from "vue";

const selectedValue = ref('no realised');

const orderStatuses = ref([
    { name: 'Nie zrealizowane', value: 'no realised' },
    { name: 'Zrealizowane', value: 'realised' },
]);

const orders = inject('orders');

const emits = defineEmits(['changeOrderStatusSelect']);

const handleSelect = (event) => {
    emits('changeOrderStatusSelect', event.target.value);
};
</script>

<template>
    {{ orders.meta.sumPrice }}
    <div class="mb-3">
        <label class="mb-1">Zrealizowane / Nie Zrealizowane</label>
        <select v-model="selectedValue" @change="handleSelect" class="form-select shadow">
            <option v-for="status in orderStatuses"
                    :value="status.value"
                    :selected="status.value === selectedValue">
                {{ status.name }}
            </option>
        </select>
    </div>
</template>

<style scoped>

</style>
