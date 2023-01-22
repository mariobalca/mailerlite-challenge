import ElementPlus from 'element-plus'
import { createApp } from 'vue'
import App from './App.vue'
import { createStore } from './store'

import 'element-plus/dist/index.css'
import './assets/main.scss'

const app = createApp(App)
const store = await createStore()

app.use(store)
app.use(ElementPlus)

app.mount('#app')
