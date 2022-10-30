import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'

console.log("ENV VARS:",process.env)
createApp(App).use(store).use(router).mount('#app')
