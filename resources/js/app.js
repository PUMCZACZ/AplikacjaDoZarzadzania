import './bootstrap.js';

// PrimeVue
import 'primevue/resources/themes/aura-light-green/theme.css';
import 'primevue/resources/primevue.min.css';
import 'primeicons/primeicons.css';

// VueJs
import {createApp} from 'vue';
import PrimeVue from 'primevue/config';
import ExportTable from "./src/components/ExportTable.vue";
import RealisationSelect from "./src/components/Dashboard/OrderDeliveryMethodSelect.vue";
import OrderTypeSelect from "./src/components/Dashboard/OrderStatusSelect.vue";
import DatePicker from "./src/components/Dashboard/DatePicker.vue";
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import ViewSumWeight from "./src/components/Dashboard/WeightCard.vue";
import DemandCards from "./src/components/Dashboard/Demand/DemandCards.vue";


// VueJs Pages
import Dashboard from "./src/views/Dashboard.vue";
import ClientIndex from "./src/views/client/Index.vue";

// Sakai imports
import '@sakai/assets/styles.scss';
import Login from "@sakai/views/pages/auth/Login.vue";
import AppLayout from './src/components/AppLayout/AppLayout.vue';


const app = createApp();

app.use(PrimeVue);
// App components
app.component('ExportTable', ExportTable);
app.component('RealisationSelect', RealisationSelect);
app.component('OrderTypeSelect', OrderTypeSelect);
app.component('DatePicker', DatePicker);
app.component('ViewSumWeight', ViewSumWeight);
app.component('DemandCards', DemandCards);


// App pages
app.component('Dashboard', Dashboard);
app.component('ClientIndex', ClientIndex);
// PrimeVue components
app.component('DataTable', DataTable);
app.component('Column', Column);

// Sakai components
app.component('AppLayout', AppLayout);
app.component('Login', Login);

app.mount("#app");
