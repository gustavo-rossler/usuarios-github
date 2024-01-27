import { createApp } from 'vue'
import App from './App.vue'
import Home from './pages/Home.vue'
import UserDetails from './pages/UserDetails.vue'
import NotFound from './pages/NotFound.vue'
import { createPinia } from 'pinia'
import { createRouter, createWebHashHistory } from 'vue-router'

import 'bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap'

const routes = [
  { path: '/', component: Home },
  { path: '/user/:username', component: UserDetails },
  { path: '/:pathMatch(.*)*', component: NotFound },
]

createApp(App)
  .use(createPinia())
  .use(createRouter({
    routes,
    history: createWebHashHistory(),
  }))
  .mount('#app')
