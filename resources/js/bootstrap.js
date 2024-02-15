
import axios from 'axios';
import { createApp } from 'vue';
import App from './vue/App.vue';
import router from './vue/router/index'
import store from './vue/store/index';

import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap';

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const app = createApp(App);
app.use(router);
app.use(store);

app.mount('#app');