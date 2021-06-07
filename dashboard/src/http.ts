import axios from 'axios'
import type { AxiosError } from 'axios'

export const http = axios.create({
  baseURL: import.meta.env.VITE_API_URL as string || 'http://localhost:8000/',
  withCredentials: true,
})

/* Helper for parsing error messsage */
export const getErrorMessage = (error: AxiosError, msgDefault?: string) => {
  if (error.response && error.response.data.errors) {
    return Object.values(error.response.data.errors).join(' ')
  }
  if (error.response && error.response.data.message) {
    return error.response.data.message
  }
  return msgDefault
}
