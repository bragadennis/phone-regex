// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'
import App from './App'
import Index from './components/Index'
import SelectComponent from './components/SelectComponent'
import VueRouter from 'vue-router'
import VueResource from 'vue-resource'
// Importing  and its dependencies
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

// Vue.use(VueMaterial)
Vue.use(BootstrapVue)
Vue.use(SelectComponent)
Vue.use(VueResource)

// Importing and dealing with Router
Vue.use(VueRouter)
const routes = [
  { path: '/', redirect: '/index' },
  { path: '/index', component: Index }
]
const router = new VueRouter({
  routes
})

Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  components: {
    'App': App,
    'Index': Index,
    'SelectComponent': SelectComponent
  },
  template: '<App/>'
})
