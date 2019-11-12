import './bootstrap';
import Vue from 'vue';

import Routes from '@/js/routes';

import App from '@/js/views/App.vue';

const app = new Vue({
    el: '#app',
    router: Routes,
    render: h => h(App),
});

export default app;
