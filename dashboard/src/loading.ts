import NProgress from 'nprogress'

let offsetStart: ReturnType<typeof setTimeout>

const start = (offset = 200) => {
  offsetStart = setTimeout(NProgress.start, offset)
}
const end = () => {
  if (offsetStart) clearTimeout(offsetStart)
  NProgress.done(false)
}

export const useLoading = () => ({
  end, start,
})
