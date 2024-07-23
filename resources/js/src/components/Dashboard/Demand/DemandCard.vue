<script setup>
const props = defineProps({
    title: String,
    demand: String,
    icon_color: String,
    bg_color: String
})
</script>

<template>
    <div class="col-12 lg:col-4">
        <div class="surface-card shadow-2 p-3 border-round">
            <div class="flex justify-content-between mb-3">
                <div>
                    <span class="block text-500 font-medium mb-3">{{ title }}</span>
                    <div class="text-900 font-medium text-xl">{{ demand }}</div>
                </div>
                <div :class="[bg_color,'flex align-items-center justify-content-center border-round']" style="width:2.5rem;height:2.5rem">
                    <i :class="[icon_color,'pi pi-inbox text-xl']"></i>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped lang="scss">

</style>
