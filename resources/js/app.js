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
import ViewSumWeight from "./components/Dashboard/WeightCard.vue";
import Dashboard from "./components/Dashboard/Dashboard.vue";
import DemandCards from "./components/Dashboard/Demand/DemandCards.vue";


// Sakai imports
import '@sakai/assets/styles.scss';
import Login from "@sakai/views/pages/auth/Login.vue";
import AppLayout from './components/AppLayout/AppLayout.vue';


const app = createApp();

app.use(PrimeVue);
// App components
app.component('ExportTable', ExportTable);
app.component('RealisationSelect', RealisationSelect);
app.component('OrderTypeSelect', OrderTypeSelect);
app.component('DatePicker', DatePicker);
app.component('ViewSumWeight', ViewSumWeight);
app.component('Dashboard', Dashboard);
app.component('DemandCards', DemandCards);


// PrimeVue components
app.component('DataTable', DataTable);
app.component('Column', Column);

// Sakai components
app.component('AppLayout', AppLayout);
app.component('Login', Login);

app.mount("#app");
