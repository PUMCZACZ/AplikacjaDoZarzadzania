<script setup>
import {onMounted, ref, provide} from 'vue';
import axios from "axios";
import DemandCard from "./DemandCard.vue";
import ExportCard from "./ExportCard.vue";
import ViewSumWeightCard from "./WeightCard.vue";
import WeightCard from "./WeightCard.vue";
import SumPriceCard from "./SumPriceCard.vue";

const data = ref();

provide('data', data);

const dataLoaded = ref(false);

const meta = ref({
    sumKg: 0,
    sumPrice: 0,
});

const handleAssignOrderMeta = (event) => {
    meta.value = event;
};

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
    <div class="grid">
        <DemandCards v-if="dataLoaded" />
        <ExportCard v-if="dataLoaded" @emitOrderMeta="handleAssignOrderMeta" />
    </div>

    <div class="grid">
        <WeightCard v-if="dataLoaded" :value="meta.sumKg" />
        <SumPriceCard v-if="dataLoaded" :value="meta.sumPrice" />
    </div>


</template>

<style scoped>

</style>
