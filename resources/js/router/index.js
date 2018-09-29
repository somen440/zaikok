import Vue from 'vue'
import VueRouter from 'vue-router'
import Vuex from 'vuex'
import * as Components from '../components'

Vue.use(VueRouter)

export default new VueRouter({
  mode: 'history',
  routes: [
    { path: '' },
    { path: '/home', component: Components.ZaikokHome },
    {
      path: '/guest',
      component: Components.ZaikokGuest,
      meta: { ignoreAuth: true },
    },
    {
      path: '/login',
      component: Components.ZaikokLogin,
      meta: { ignoreAuth: true },
    },
    {
      path: '/register',
      component: Components.ZaikokRegister,
      meta: { ignoreAuth: true },
    },
  ],
})
