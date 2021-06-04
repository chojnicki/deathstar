import { useAuthStore } from '@/stores/auth'

export const guestMiddleware = async () => {
  const auth = useAuthStore()
  return auth.getters.isLogged ? { name: 'dashboard' } : true
}
