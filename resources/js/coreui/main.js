// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import 'es6-promise/auto'
import axios from 'axios'
import VueAuth from '@websanova/vue-auth'
import VueAxios from 'vue-axios'
import VueRouter from 'vue-router'
import auth from '../auth'
import BootstrapVue from 'bootstrap-vue'
import Datepicker from 'vuejs-datepicker'
import { id } from 'vuejs-datepicker/dist/locale'
import Notifications from 'vue-notification'
import Sweetalert from 'vue-sweetalert2'
import Vuelidate from 'vuelidate'
import Loading from './components/Loading'
import Select2 from './components/Select'
import App from './App'
import router from './router'
import store from './store'

Vue.use(BootstrapVue)
Vue.use(Notifications)
Vue.use(Sweetalert)
Vue.use(Vuelidate)
Vue.use(VueRouter)
Vue.filter('state', (value, dirtyOnly = true) => {
  if (dirtyOnly) {
    if (!value.$dirty)
      return null
  }

  return !value.$invalid ? 'valid' : 'invalid'
})

Vue.use(VueAxios, axios)
axios.defaults.baseURL = `${process.env.MIX_APP_URL}/api`
Vue.use(VueAuth, auth)

Vue.component('b-loading', Loading)
Vue.component('b-select-2', Select2)
Vue.component('b-datepicker', {
  extends: Datepicker,
  props  : {
    bootstrapStyling: {
      type   : Boolean,
      default: true,
    },
    language: {
      type   : Object,
      default: () => id,
    },
  },
})

export default new Vue({
  el        : '#app',
  router    : router,
  store     : store,
  components: { App },
  template  : '<App/>',
})
