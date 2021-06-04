import { createRouter, createWebHistory } from 'vue-router'
import { useLoading } from '@/loading'
import Dashboard from '@/pages/dashboard.vue'
import Demo from '@/pages/demo.vue'
import Login from '@/pages/login.vue'
import Error404 from '@/pages/404.vue'
import { runMiddlewares } from '@/middleware'

const routes = [
  {
    path: '/',
    component: Dashboard,
    name: 'dashboard',
    meta: {
      middleware: ['auth'],
    },
  },
  {
    path: '/demo',
    component: Demo,
    name: 'demo',
    meta: {
      middleware: ['auth'],
    },
  },
  {
    path: '/login',
    component: Login,
    name: 'login',
    meta: {
      middleware: ['guest'],
    },
  },
  {
    path: '/:pathMatch(.*)*',
    component: Error404,
    name: '404',
  },
]

export const router = createRouter({
  history: createWebHistory(),
  routes,
})

const loading = useLoading()

router.beforeEach(runMiddlewares)

router.beforeEach(() => {
  loading.start()
})

router.afterEach(() => {
  loading.end()
})
