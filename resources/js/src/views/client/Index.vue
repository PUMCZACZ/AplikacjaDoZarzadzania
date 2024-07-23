<script setup>
import TableAction from "../../components/Client/TableAction.vue";
const props = defineProps({
    clients: Object
});

</script>

<template>
    <DataTable :value="clients" :paginator="true" :rows="10" :rowsPerPageOptions="[5,10,20]">
        <Column field="id" header="ID" sortable></Column>
        <Column field="full_name" header="Imię i nazwisko" sortable></Column>
        <Column field="phone_number" header="Numer Tel" sortable></Column>
        <Column field="full_address" header="Zamiesznaknie" sortable></Column>
        <Column header="Akcje">
            <template #body="slot">
                <TableAction />
            </template>
        </Column>
    </DataTable>
</template>

<style scoped lang="scss">

</style>
