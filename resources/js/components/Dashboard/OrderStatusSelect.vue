<script setup>
import Dropdown from 'primevue/dropdown';
import {ref, inject} from "vue";

const selectedValue = ref('no realised');

const orderStatuses = ref([
    { name: 'Nie zrealizowane', value: 'no realised' },
    { name: 'Zrealizowane', value: 'realised' },
]);

const emits = defineEmits(['changeOrderStatusSelect']);

const handleSelect = (event) => {
    emits('changeOrderStatusSelect', event.value);
};
</script>

<template>
    <div class="col-6">
        <div class="surface-card shadow-2 p-3 border-round">
            <div>
                <span class="block text-500 font-medium mb-3">Status realizacji</span>
                <div class="text-900 font-medium text-xl">
                    <Dropdown v-model="selectedValue"
                              @change="handleSelect"
                              :options="orderStatuses"
                              optionLabel="name"
                              optionValue="value" />
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
