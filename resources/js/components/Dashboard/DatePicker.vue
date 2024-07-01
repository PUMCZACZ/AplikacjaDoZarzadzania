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
    <div class="d-flex flex-column w-100">
        <label class="mb-1">{{ label }}</label>
        <input type="date" v-model="date" class="form-control" @change="changeDate"/>
    </div>
</template>

<style scoped>

</style>
