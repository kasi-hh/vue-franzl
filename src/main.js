import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
//import 'bootstrap/dist/css/bootstrap.css'
import './darkly.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import Bootstrap from './register-bootstrap'

Vue.config.productionTip = false;
Vue.use(Bootstrap);

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
