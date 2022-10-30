import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
//import axios from "axios"
import {createAuth0} from "@auth0/auth0-vue"

const ENV = process.env
//console.log("ENV VARS:",ENV)
//axios.get(process.env.VUE_APP_MOVIES_ENDPOINT).then( result => console.log(result.data))

createApp(App).
    use(store).
    use(router).
    //use(axios). //da error de recursividad
    use(createAuth0({
        domain: ENV.VUE_APP_AUTH0_DOMAIN,
        client_id: ENV.VUE_APP_AUTH0_CLIENT_ID,
        redirect_uri: ENV.VUE_APP_AUTH0_LOGIN_CALLBACK,
    })).
    mount('#app')
