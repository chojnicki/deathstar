<template>
  <form
    class="flex flex-col p-8"
    @submit.prevent="onSubmit"
  >
    <input
      v-model="form.email"
      class="form-input my-2"
      type="email"
      placeholder="Email"
      required
    >
    <input
      v-model="form.password"
      class="form-input my-2"
      type="password"
      placeholder="Password"
      required
    >

    <label class="my-2 flex items-center">
      <input
        v-model="form.remember"
        type="checkbox"
        class="form-checkbox"
      >
      <span class="ml-2">Zapamiętaj</span>
    </label>
    <button
      type="submit"
      class="btn btn-outline my-2"
    >
      Zaloguj
    </button>
  </form>
</template>

<script setup lang="ts">
import { reactive } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '@/stores/auth'
import { useLoading } from '@/loading'
import { useToast } from 'vue-toastification'

const auth = useAuthStore()
const router = useRouter()
const loading = useLoading()
const toast = useToast()

const form = reactive({
  email: 'demo@example.com',
  password: 'password',
  remember: true,
})

const onSubmit = () => {
  loading.start()
  auth.login(form)
    .then(() => {
      router.push({ name: 'dashboard' })
      toast(`Welcome back in the command center, ${auth.state.user.name}!`)
    })
    .catch((err) => {
      toast.error(err.response.data.message)
    })
    .finally(() => {
      loading.end()
    })
}
</script>
