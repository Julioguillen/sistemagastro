
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue';
import VeeValidate from 'vee-validate';
Vue.use(VeeValidate);
import VueModalTor from 'vue-modaltor'

Vue.use(VueModalTor)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


Vue.component('herramientas', require('./components/Herramientas.vue'));
Vue.component('equipos', require('./components/Equipos.vue'));
Vue.component('usuarios', require('./components/Usuarios.vue'));
Vue.component('cristaleria', require('./components/Cristaleria.vue'));
Vue.component('mueble', require('./components/Mueble.vue'));
Vue.component('danados', require('./components/Dañados.vue'));
Vue.component('cubiertos', require('./components/Cubiertos.vue'));
Vue.component('limpieza', require('./components/Limpieza.vue'));




const app = new Vue({

    el: '#app',

    data : {
    	menu :  0

          }

});
