<template>
  <div>
    <form @submit.prevent="onSubmit">
      <input
        v-model="form.email"
        type="email"
        placeholder="Email"
        required
      >
      <input
        v-model="form.password"
        type="password"
        placeholder="Password"
        required
      >

      <label>
        <span>Zapamiętaj</span>
        <input
          v-model="form.remember"
          type="checkbox"
        ></label>
      <button
        type="submit"
      >
        Zaloguj
      </button>
    </form>
  </div>
</template>

<script setup lang="ts">
import { defineProps, reactive } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '@/stores/auth'
import { useLoading } from '@/loading'

const auth = useAuthStore()
const router = useRouter()
const loading = useLoading()

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
    })
    .catch((err) => {
      alert(err.response.data.message)
    })
    .finally(() => {
      loading.end()
    })
}
</script>

<style>
/* css */
</style>
