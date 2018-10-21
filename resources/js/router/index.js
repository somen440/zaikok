import Vue from 'vue'
import VueRouter from 'vue-router'
import * as Components from '../components'

Vue.use(VueRouter)

export default new VueRouter({
  mode: 'history',
  routes: [
    { path: '/home/:id', component: Components.ZaikokInventory },
    { path: '/line_verify', component: Components.ZaikokLineVerify },
  ],
})
