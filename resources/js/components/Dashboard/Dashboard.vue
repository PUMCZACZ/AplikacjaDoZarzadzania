<script setup>
import {onMounted, ref} from 'vue';
import axios from "axios";
import DemandCard from "./DemandCard.vue";

const data = ref();

const dataLoaded = ref(false);

onMounted(() => {
    axios.get('api/dashboard/data')
        .then(res => {
            data.value = res.data;
            dataLoaded.value = true;
        })
        .catch(error => console.log(error));
});
</script>

<template>
    <DemandCard v-if="dataLoaded" :demands="data.demands"></DemandCard>
</template>

<style scoped>

</style>
