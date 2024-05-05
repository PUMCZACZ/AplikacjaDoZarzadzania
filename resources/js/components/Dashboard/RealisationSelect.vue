<script setup>
import {ref} from "vue";

const selected_value = ref('all');

const props = defineProps({
    realisation_statuses: '',
});

</script>

<template>
    <div>
        <label class="form-label">Kategoria</label>
        <select v-model="selected_value" class="form-select shadow mb-2">
            <option value="all" selected>Wszystkie</option>
            <option v-for="(name, key) in realisation_statuses" :value="key">{{ name }}</option>
        </select>
    </div>

</template>
