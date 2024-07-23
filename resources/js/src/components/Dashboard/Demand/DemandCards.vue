<script setup>
import {inject} from "vue";
import DemandCard from "./DemandCard.vue";

const data = inject('data');
</script>

<template>
    <DemandCard title="Aktualny miesiąc"
                :demand="data.demands.demand"
                icon_color="text-red-500"
                bg_color="bg-red-50"/>

    <DemandCard title="Następny miesiąc"
                :demand="data.demands.nextMonthDemand"
                icon_color="text-blue-500"
                bg_color="bg-blue-50"/>

    <DemandCard title="Za dwa miesiące"
                :demand="data.demands.nextTwoMonthDemand"
                icon_color="text-green-600"
                bg_color="bg-green-50"/>
</template>

<style scoped lang="scss">

</style>
