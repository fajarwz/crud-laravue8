require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import VueAxios from 'vue-axios';
import axios from 'axios';
Vue.use(VueAxios, axios);

import App from './App.vue';

import IndexComponent from './components/posts/Index.vue'
import EditComponent from './components/posts/Edit.vue'
import CreateComponent from './components/posts/Create.vue'

const routes = [
  {
    name      : 'posts',
    path      : '/',
    component : IndexComponent
  },
  {
    name      : 'create',
    path      : '/create',
    component : CreateComponent
  },
  {
    name      : 'edit',
    path      : '/edit',
    component : EditComponent
  }
];

const router = new VueRouter({
  mode    : 'history',
  routes  : routes
})

const app = new Vue(Vue.util.extend({router} , App)).$mount('#app');