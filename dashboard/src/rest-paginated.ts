import { reactive, computed } from 'vue'
import { http } from '@/http'
import { useLoading } from '@/loading'

type DataItemType = {
  id: number,
  [key: string]: string | number | null
}

export const useRestPaginated = (url: string, loadingEnabled = true) => {
  const state = reactive({
    data: null as DataItemType[] | null,
    totalItems: 0,
    currentPage: 1,
    totalPages: 1,
    perPage: 10,
  })

  const getters = reactive({
    isNextPage: computed(() => state.currentPage < state.totalPages),
    isPrevPage: computed(() => state.currentPage > 1),
  })

  /* Get/refresh data from api */
  const fetchData = () => {
    if (loadingEnabled) useLoading().start()
    return http.get(url, {
      params: {
        page: state.currentPage,
        per_page: state.perPage,
      },
    })
      .then((response) => {
        state.data = response.data.data
        state.totalItems = response.data.meta.total
        state.totalPages = response.data.meta.last_page
      })
      .finally(() => {
        if (loadingEnabled) useLoading().end()
      })
  }

  /* Change page and get data for it */
  const changePage = (page: number) => {
    state.currentPage = page
    return fetchData()
  }

  const nextPage = () => {
    if (getters.isNextPage) {
      changePage(state.currentPage + 1)
    }
  }

  const prevPage = () => {
    if (getters.isPrevPage) {
      changePage(state.currentPage - 1)
    }
  }

  return {
    state,
    getters,
    fetchData,
    changePage,
    nextPage,
    prevPage,
  }
}
