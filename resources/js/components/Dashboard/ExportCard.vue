<script setup>
import {inject, ref} from "vue";
import ExportTable from "../ExportTable.vue";

const data = inject('data');

const test = ref();

const handleRef = (event) => {
    test.value = event;
};

const emits = defineEmits(['emitOrderMeta']);

const orderMetaDataLoaded = (event) => {
    emits('emitOrderMeta', event);
};
</script>

<template>
    <div class="card mt-2 shadow-lg p-3 mb-4 bg-body rounded">
        <div class="card-header shadow p-3 mb-4 bg-body rounded">
            <h1><i class="bi bi-truck pd-1 text-danger" style="font-size: 2rem;"> </i>Tabela wywozów / odbiorów</h1>
        </div>
        <div class="card-body">
            <div class="row">
                <ExportTable :deliveryMethods="data.deliveryMethods" @emitOrderMeta="orderMetaDataLoaded"/>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
