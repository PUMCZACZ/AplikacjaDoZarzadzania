<script setup>
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Dropdown from 'primevue/dropdown';
import OrderStatusSelect from "./Dashboard/OrderStatusSelect.vue";
import axios from "axios";
import { reactive, onMounted, ref } from 'vue';
import OrderDeliveryMethodSelect from "./Dashboard/OrderDeliveryMethodSelect.vue";

const orders = ref([]);

const props = defineProps({
    deliveryMethods: JSON,
})

const params = reactive({
    date_from: '2024-03-01',
    date_to: '2024-05-01',
    realisation_status: 'no realised',
    delivery_type: 'on site',
})

const handleOrderStatusSelectChange = (value) => {
    params.realisation_status = value;
    fetchOrders();
};

const handleOrderDeliverySelectChange = (value) => {
    params.delivery_type = value;
    fetchOrders();
}

const fetchOrders = () => {
    axios.post('api/dashboard/orders', {params},)
        .then(res => orders.value = res.data.data)
        .catch(error => console.log(error))
}


onMounted(() => fetchOrders());

</script>

<template>
    <OrderStatusSelect @changeOrderStatusSelect="handleOrderStatusSelectChange" />

    <OrderDeliveryMethodSelect :deliveryMethods="deliveryMethods" @changeOrderDeliveryMethodSelect="handleOrderDeliverySelectChange"/>

    {{ params }}

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
