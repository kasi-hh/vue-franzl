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

router.beforeEach((to, from, next)=>{
    console.log('router', to, from)
    const token = localStorage.getItem('token');
    if (to.name === 'login') {
        next();
        return;
    }
    if (!token) {
        next('/login');
        return;
    }
    next();
})

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
