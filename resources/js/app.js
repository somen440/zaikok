/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap')

import Vue from 'vue'
import Vuetify from 'vuetify'
import App from './App.vue'
import * as Components from './components'
import router from './router'
import 'vuetify/dist/vuetify.min.css'
import 'material-design-icons-iconfont'

Vue.use(Vuetify)
Object.keys(Components).forEach(k => {
  Vue.component(k, Components[k])
})

new Vue({
  router,
  render: h => h(App),
}).$mount('#app')
