/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');
// Vue.component('example', require('./components/Example.vue'));
// window.Vue = require('vue');
// import VueRouter from 'vue-router';
// Vue.use(VueRouter);

// import file yang dibuat tadi
// import App from './components/App.vue';
// import Create from './components/Create.vue';
// import Read from './components/Read.vue';
// import Update from './components/Update.vue';
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// membuat router
// const routes = [
//     {
//         name: 'read',
//         path: '/',
//         component: Read
//     },
//     {
//         name: 'create',
//         path: '/create',
//         component: Create
//     },
//     {
//         name: 'update',
//         path: '/detail/:id',
//         component: Update
//     }
// ]

// const router = new VueRouter({ mode: 'history', routes: routes });
// new Vue(Vue.util.extend({ router }, App)).$mount("#app");

import './bootstrap'

import Vue from 'vue'
import VueRouter from 'vue-router'
import routes from './router'
Vue.use(VueRouter)
// import App from './layouts/App.vue'

Vue.component('navigation', require('./views/section/Navigation').default);
Vue.component('copyright', require('./views/section/Footer').default);

// new Vue({
//     router,
//     el: '#app',
//     render: h => h(App)
// })
const app = new Vue({
  el: '#app',
  router: new VueRouter(routes),
  
});




