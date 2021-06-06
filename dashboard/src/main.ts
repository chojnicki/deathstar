import { createApp } from 'vue'
import { router } from '@/router'
import Toast from 'vue-toastification'
import App from './App.vue'

createApp(App)
  .use(router)
  .use(Toast, {
    position: 'top-center',
  })
  .mount('#app')
