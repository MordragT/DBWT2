/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

//window.Vue = require('vue');
import Vue from 'vue';


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('artikel', require('./components/Artikel.vue').default);
Vue.component('sell-form', require('./components/SellForm.vue').default);
Vue.component('nav-menu', require('./components/Menu/Menu.vue').default);
Vue.component('statistics', require('./components/Statistics.vue').default);
Vue.component('impressum', require('./components/Impressum.vue').default);
Vue.component('register', require('./components/Register.vue').default);
Vue.component('login', require('./components/Login.vue').default);

import VueGoodTablePlugin from 'vue-good-table';
Vue.use(VueGoodTablePlugin);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data: {
        columns: [
            {
                label: 'Name',
                field: 'name',

            },
            {
                label: 'Age',
                field: 'age',
                type: 'number',
            },
            {
                label: 'Created On',
                field: 'createdAt',
                type: 'date',
                dateInputFormat: 'yyyy-MM-dd',
                dateOutputFormat: 'MMM Do yy',
            },
            {
                label: 'Percent',
                field: 'score',
                type: 'percentage',
            }
        ],
        rows: [
            { id: 1, name: "John", age: 20, createdAt: '', score: 0.03343 },
            { id: 2, name: "Jane", age: 24, createdAt: '2011-10-31', score: 0.03343 },
            { id: 3, name: "Susan", age: 16, createdAt: '2011-10-30', score: 0.03343 },
            { id: 4, name: "Chris", age: 55, createdAt: '2011-10-11', score: 0.03343 },
            { id: 5, name: "Dan", age: 40, createdAt: '2011-10-21', score: 0.03343 },
            { id: 6, name: "Elaine", age: 20, createdAt: '2011-10-04', score: 0.03343 },
            { id: 7, name: "Sonja", age: 60, createdAt: '2014-02-30', score: 0.03343 },
            { id: 8, name: "Hans", age: 43, createdAt: '2020-01-02', score: 0.03343 },
        ]

    }
});
