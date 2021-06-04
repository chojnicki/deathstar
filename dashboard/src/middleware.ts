import { RouteLocationNormalized, RouteLocationRaw, RouteMeta } from 'vue-router'
import { authMiddleware } from '@/middleware/auth'
import { guestMiddleware } from '@/middleware/guest'

type MiddlewareReturn = RouteLocationRaw | void | boolean
interface MiddlewareRouteMeta extends RouteMeta {
  middleware?: string[]
}
interface MiddlewareRoute extends RouteLocationNormalized {
  meta: MiddlewareRouteMeta
}
interface Middleware {
  (to: MiddlewareRoute, from: RouteLocationNormalized): MiddlewareReturn | Promise<MiddlewareReturn>
}

/* Available middlewares */
const middlewares: Record<string, Middleware> = {
  auth: authMiddleware,
  guest: guestMiddleware,
}

/* Execute middlewares in router beforeEach() */
export const runMiddlewares: Middleware = async (to, from) => {
  if (!to.meta.middleware) return true
  const names: string[] = to.meta.middleware

  let result: MiddlewareReturn
  // eslint-disable-next-line no-restricted-syntax
  for (const name of names) {
    result = await middlewares[name](to, from)
    if (result || result === false) {
      break
    }
  }

  return result
}
