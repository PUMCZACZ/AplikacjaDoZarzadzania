<script setup>
import OrderStatusSelect from "./Dashboard/OrderStatusSelect.vue";
import axios from "axios";
import { reactive, onMounted, ref, provide } from 'vue';
import OrderDeliveryMethodSelect from "./Dashboard/OrderDeliveryMethodSelect.vue";
import DatePicker from "./Dashboard/DatePicker.vue";
import { FilterMatchMode } from 'primevue/api';

const orders = ref({
    data: [],
    meta: {},
});

provide('orders', orders.value);

const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
});

const props = defineProps({
    deliveryMethods: JSON,
})

const dateNow = new Date().toLocaleDateString('en-ca');

const params = reactive({
    date_from: dateNow,
    date_to: dateNow,
    realisation_status: 'no realised',
    delivery_type: 'all',
})

const handleOrderStatusSelectChange = (value) => {
    params.realisation_status = value;
    fetchOrders();
};

const handleOrderDeliverySelectChange = (value) => {
    params.delivery_type = value;
    fetchOrders();
}

const handleChangeDateFrom = (value) => {
    params.date_from = value;
    fetchOrders();
}

const handleChangeDateTo = (value) => {
    params.date_to = value;
    fetchOrders();
}

const fetchOrders = () => {
    axios.post('api/dashboard/orders', params,)
        .then(res => {
            orders.value.data = res.data.data;
            orders.value.meta = res.data.meta;
        })
        .catch(error => console.log(error))
}

onMounted(() => fetchOrders());

</script>

<template>
    <div class="d-flex flex-column flex-sm-row gap-3 mb-3">
        <DatePicker label="Od" @changeDate="handleChangeDateFrom"/>
        <DatePicker label="Do" @changeDate="handleChangeDateTo"/>
    </div>
    <div class="mb-4">
        <OrderStatusSelect @changeOrderStatusSelect="handleOrderStatusSelectChange" />

        <OrderDeliveryMethodSelect :deliveryMethods="deliveryMethods" @changeOrderDeliveryMethodSelect="handleOrderDeliverySelectChange"/>
    </div>

    <DataTable v-model:filters="filters" :value="orders.data"
               :globalFilterFields="['client', 'order_name', 'order_type', 'quantity', 'price', 'deadline']"
               :pt="{table: 'table table-striped'}">
        <template #header>
            <div class="d-flex justify-content-end">
                <IconField iconPosition="left">
                    <InputIcon>
                        <i class="pi pi-search" />
                    </InputIcon>
                    <InputText v-model="filters['global'].value" placeholder="Wyszukaj w tabeli" />
                </IconField>
            </div>
        </template>

      <Column field="id" header="Id" sortable></Column>
      <Column field="client" header="Klient" sortable></Column>
      <Column field="order_name" header="Nazwa Zamówienia"sortable></Column>
      <Column field="order_type" header="Typ Zamówienia" sortable></Column>
      <Column field="quantity" header="Ilość" sortable></Column>
      <Column field="price" header="Cena" sortable></Column>
      <Column field="deadline" header="Termin Realizacji" sortable></Column>
    </DataTable>
</template>

<style scoped>

</style>
