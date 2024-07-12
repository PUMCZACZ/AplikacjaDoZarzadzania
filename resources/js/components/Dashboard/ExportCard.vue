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
    <div class="col-12">
        <Card>
            <template #header>
                <h1 class="pl-4 pt-4">Tabela wywozów / odbiorów</h1>
            </template>
            <template #content>
                <ExportTable :deliveryMethods="data.deliveryMethods" @emitOrderMeta="orderMetaDataLoaded"/>
            </template>
        </Card>
    </div>

</template>

<style scoped>

</style>
