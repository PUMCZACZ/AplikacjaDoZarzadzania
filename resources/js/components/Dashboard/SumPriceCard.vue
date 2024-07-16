<script setup>
import Card from "primevue/card";

const props = defineProps({
    value: Number,
})
</script>

<template>
    <div class="col-12 sm:col-6">
        <Card>
            <template #header>
                <h3 class="pt-4 m-0 text-center">Suma ze wszystkich zamówień</h3>
            </template>
            <template #content>
                <p class="text-center">{{ value }} kg</p>
            </template>
        </Card>
    </div>

</template>

<style scoped lang="scss">
    p {
        font-size: 2rem;
    }
</style>
