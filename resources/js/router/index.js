import Vue from 'vue'
import VueRouter from 'vue-router'
import Vuex from 'vuex'
import * as Components from '../components'

Vue.use(VueRouter)

export default new VueRouter({
  mode: 'history',
  routes: [
    // { path: '/home', component: Components.ZaikokHome },
  ],
})
