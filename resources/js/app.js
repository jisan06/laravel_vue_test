require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import App from './components/App.vue';
import VueSweetalert2 from 'vue-sweetalert2'; 
// If you don't need the styles, do not connect
import 'sweetalert2/dist/sweetalert2.min.css';

Vue.component('pagination', require('laravel-vue-pagination')); 

Vue.use(VueRouter);
Vue.use(VueSweetalert2);
Vue.use(VueAxios, axios);

import ServiceIndex from './components/Services/Index.vue';
import ServiceCreate from './components/Services/Create.vue';

import PassengerIndex from './components/Passenger/Index.vue';
import PassengerCreate from './components/Passenger/Create.vue';

const routes = [
  {
      name: 'home',
      path: '/',
      component: ServiceIndex
  },
  {
      name: 'create-service',
      path: '/service/create',
      component: ServiceCreate
  },

  {
      name: 'passengers',
      path: '/passengers',
      component: PassengerIndex
  },
  {
      name: 'create-passenger',
      path: '/passenger/create',
      component: PassengerCreate
  },
];

const router = new VueRouter({ mode: 'history', routes: routes});
const app = new Vue(Vue.util.extend({ router }, App)).$mount('#app');