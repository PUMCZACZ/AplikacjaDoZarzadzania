<script setup>
import {onBeforeMount, onMounted, ref} from "vue";
import Dropdown from "primevue/dropdown";

const selectedValue = ref('all');

const props = defineProps({
    deliveryMethods: JSON,
});

const allOption = { name: 'Wszystkie', value: 'all' }

let data = ref([]);

onBeforeMount(() => {
   data = [allOption, ...props.deliveryMethods]
});

const emits = defineEmits(['changeOrderDeliveryMethodSelect']);

const handleSelect = (event) => {
    emits('changeOrderDeliveryMethodSelect', event.value);
};

</script>

<template>
    <div class="col-12 sm:col-6">
        <div class="surface-card shadow-2 p-3 border-round">
            <div>
                <span class="block text-500 font-medium mb-3">Kategoria</span>
                <div class="text-900 font-medium text-xl">
                    <Dropdown v-model="selectedValue"
                              @change="handleSelect"
                              :options="data"
                              optionLabel="name"
                              optionValue="value" />
                </div>
            </div>
        </div>
    </div>
</template>
