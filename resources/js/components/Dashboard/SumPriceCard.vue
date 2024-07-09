<script setup>
const props = defineProps({
    value: Number,
})
</script>

<template>
    <div class="card mt-2 shadow-lg p-3 mb-5 bg-body rounded">
        <div class="price card-header shadow p-3 mb-4 bg-body rounded">
            <i class="bi bi-cash-coin pd-1 text-danger" style="font-size: 2rem;"> </i>Suma ze wszystkich zamówień
        </div>
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-6 text-center">
                    <p class="text-center inline" style="font-size:4rem;" id="sumValue"></p>
                    <p class="inline" style="font-size:2rem;">{{ value }} zł</p>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
