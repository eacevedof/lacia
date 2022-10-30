import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import axios from "axios"


console.log("ENV VARS:",process.env)
axios.get(process.env.VUE_APP_MOVIES_ENDPOINT).then( result => console.log(result.data))

createApp(App).use(store).use(router).mount('#app')
