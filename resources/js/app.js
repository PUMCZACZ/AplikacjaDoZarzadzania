// Bootstrap imports
import './bootstrap';
import 'bootstrap';
import '@popperjs/core';

// PrimeVue
import 'primevue/resources/themes/aura-light-green/theme.css';
import 'primevue/resources/primevue.min.css';
import 'primeicons/primeicons.css';

// VueJs
import {createApp} from 'vue';
import PrimeVue from 'primevue/config';
import ExportTable from "./components/ExportTable.vue";
import RealisationSelect from "./components/Dashboard/OrderDeliveryMethodSelect.vue";
import OrderTypeSelect from "./components/Dashboard/OrderStatusSelect.vue";
import DatePicker from "./components/Dashboard/DatePicker.vue";
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';


const app = createApp();

app.use(PrimeVue);

// App components
app.component('ExportTable', ExportTable);
app.component('RealisationSelect', RealisationSelect);
app.component('OrderTypeSelect', OrderTypeSelect);
app.component('DatePicker', DatePicker);

// PrimeVue components
app.component('DataTable', DataTable);
app.component('Column', Column);

app.mount("#app");
