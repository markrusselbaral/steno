import { createApp } from 'vue'
import App from './App.vue'
import router from './router'

import "bootstrap/dist/css/bootstrap.min.css"
import "bootstrap"

import Particless from "vue3-particles";



const app = createApp(App)


app.use(router)
app.use(Particless);
app.mount('#app')
