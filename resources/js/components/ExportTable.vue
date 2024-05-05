<script setup>
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Dropdown from 'primevue/dropdown';
import axios from "axios";
import { ref, onMounted } from 'vue';

const orders = ref([]);

const params = {
    date_from: '2024-03-01',
    date_to: '2024-05-01',
    realisation_status: 'no realised',
    delivery_type: 'on site',
}

function fetchOrders() {
    axios.get('api/dashboard/orders', {params},)
        .then(res => orders.value = res.data.data)
        .catch(error => console.log(error))
}

onMounted(() => fetchOrders());

console.log(orders)
</script>

<template>


    <data-table :value="orders">
      <column field="id" header="Id"></column>
      <column field="client" header="Klient"></column>
      <column field="order_name" header="Nazwa Zamówienia"></column>
      <column field="order_type" header="Typ Zamówienia"></column>
      <column field="quantity" header="Ilość"></column>
      <column field="price" header="Cena"></column>
      <column field="deadline" header="Termin Realizacji"></column>
  </data-table>
</template>

<style scoped>

</style>
