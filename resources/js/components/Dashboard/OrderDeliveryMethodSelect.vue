<script setup>
import {ref} from "vue";

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
    <div>
        <label class="form-label">Kategoria</label>
        <select v-model="selected_value" @change="handleSelect" class="form-select shadow mb-2">
            <option value="all" selected>Wszystkie</option>
            <option v-for="(name, key) in deliveryMethods" :value="key">{{ name }}</option>
        </select>
    </div>
</template>
