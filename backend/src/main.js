import './assets/main.css'
import store from './store'
import './index.css'
import { createApp } from 'vue'
import router from './router'
import App from './App.vue'

createApp(App)
.use(store)
.use(router)
.mount('#app')
