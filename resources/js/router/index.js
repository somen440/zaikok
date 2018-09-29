import Vue from 'vue'
import VueRouter from 'vue-router'
import * as Components from '../components'

Vue.use(VueRouter)

export default new VueRouter({
  mode: 'history',
  routes: [
    { path: '/', component: Components.ZaikokHome },
    { path: '/login', component: Components.ZaikokLogin },
    { path: '/register', component: Components.ZaikokRegister },
  ],
})
