<script setup>
import {onMounted, ref, provide} from 'vue';
import axios from "axios";
import DemandCard from "./DemandCard.vue";
import ExportCard from "./ExportCard.vue";
import ViewSumWeightCard from "./WeightCard.vue";
import WeightCard from "./WeightCard.vue";
import SumPriceCard from "./SumPriceCard.vue";

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

provide('data', data);
</script>

<template>
    <DemandCard v-if="dataLoaded" />
    <ExportCard v-if="dataLoaded" />
    <WeightCard v-if="dataLoaded" />
    <SumPriceCard v-if="dataLoaded" />

</template>

<style scoped>

</style>
