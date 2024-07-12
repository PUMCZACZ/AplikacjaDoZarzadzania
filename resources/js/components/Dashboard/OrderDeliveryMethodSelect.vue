<script setup>
import {ref} from "vue";
import Dropdown from "primevue/dropdown";

const selected_value = ref('all');

const props = defineProps({
    deliveryMethods: JSON,
});

const emits = defineEmits(['changeOrderDeliveryMethodSelect']);

const handleSelect = (event) => {
    emits('changeOrderDeliveryMethodSelect', event.target.value);
};

</script>

<template>
    <div class="col-6">
        <div class="surface-card shadow-2 p-3 border-round">
            <div>
                <span class="block text-500 font-medium mb-3">Kategoria</span>
                <div class="text-900 font-medium text-xl">
                    <select v-model="selected_value"
                            @change="handleSelect"
                            class="outline-gray-50 rounded focus:outline-green-500">
                        <option value="all" selected>Wszystkie</option>
                        <option v-for="(name, key) in deliveryMethods" :value="key">{{ name }}</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</template>
