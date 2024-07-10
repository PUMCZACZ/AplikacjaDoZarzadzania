<script setup>
const props = defineProps({
    value: Number,
})
</script>

<template>
    <div class="card mt-2 shadow-lg p-3 mb-5 bg-body rounded flex-fill">
        <div class="card-header shadow d-flex align-items-center p-3 bg-body rounded">
            <i class="bi bi-box-seam text-danger me-2 fs-3"></i>
            Suma ze wszystkich zamówień
        </div>
        <div class="card-body d-flex justify-content-center align-items-center">
            <p class="fs-1" style="font-size:2rem;">{{ value }} kg</p>
        </div>
    </div>
</template>

<style scoped>

</style>
