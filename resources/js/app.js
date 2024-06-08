// Bootstrap imports
import './bootstrap';
import 'bootstrap';
import '@popperjs/core';

import 'primevue/resources/themes/aura-light-green/theme.css';
import 'primevue/resources/primevue.min.css';

// VueJs
import {createApp} from 'vue';
import PrimeVue from 'primevue/config';
import ExportTable from "./components/ExportTable.vue";
import RealisationSelect from "./components/Dashboard/OrderDeliveryMethodSelect.vue";
import OrderTypeSelect from "./components/Dashboard/OrderStatusSelect.vue";

const vue = createApp();

vue.use(PrimeVue);

vue.component('ExportTable', ExportTable);
vue.component('RealisationSelect', RealisationSelect);
vue.component('OrderTypeSelect', OrderTypeSelect);

vue.mount("#app");
