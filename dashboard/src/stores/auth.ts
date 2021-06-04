import { reactive, readonly, computed } from 'vue'
import type { Ref } from 'vue'
import { http } from '@/http'
import { useStorage } from '@vueuse/core'

type ModelUser = {
  id: number,
  email: string,
  name: string,
}

/* Store state with current user data */
const state = reactive({
  user: useStorage('auth.user', {}) as Ref<ModelUser | Record<string, never>>, // cannot use null
})

/* Store computed getters */
const getters = reactive({
  isLogged: computed(() => !!state.user.id),
})

/* Fetch fresh user data from backend to state */
const refreshUserData = () => http.get('auth/me')
  .then((response) => {
    state.user = response.data.data
  })
  .catch((error) => {
    if (error.response?.status === 401) {
      state.user = {}
    }
    throw error
  })

/* Log in to backend */
const login = async ({ ...data }: {
  email: string,
  password: string,
  remember: boolean,
}) => {
  await http.post('auth/login', data)
    .then((response) => {
      state.user = response.data.data
    })
}

/* Logout by removing user state and flushing session on backend */
const logout = () => {
  state.user = {}
  http.post('auth/logout')
}

/* Get CSRF token from backend */
const refreshCsrf = async () => http.get('sanctum/csrf-cookie')

export const useAuthStore = () => ({
  state: readonly(state),
  getters,
  refreshCsrf,
  refreshUserData,
  login,
  logout,
})
