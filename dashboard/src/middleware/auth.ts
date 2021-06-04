import { useAuthStore } from '@/stores/auth'

export const authMiddleware = async () => {
  const auth = useAuthStore()
  return auth.getters.isLogged ? true : { name: 'login' }
}
