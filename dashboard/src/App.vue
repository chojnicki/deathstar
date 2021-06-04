<template>
  <header>
    TODO header
    <router-link :to="{ name: 'login'}">
      Login
    </router-link>
    <router-link :to="{ name: 'dashboard'}">
      Dashboard
    </router-link>
    <router-link :to="{ name: 'demo'}">
      Demo
    </router-link>
    <a
      href="javascript:"
      @click="onLogoutClick"
    >Logout</a>
  </header>
  <router-view />
  <footer>
    TODO footer {{ auth.getters.isLogged }} {{ auth.state.user }}
  </footer>
</template>

<script setup lang="ts">
import { useAuthStore } from '@/stores/auth'
import { useRouter } from 'vue-router'

const auth = useAuthStore()
const router = useRouter()

const onLogoutClick = () => {
  auth.logout()
  router.push({ name: 'login' })
}

auth.refreshCsrf()
if (auth.getters.isLogged) {
  auth.refreshUserData()
    .catch((error) => {
      if (error.response?.status === 401) {
        router.push({ name: 'login' })
      }
    })
}
</script>

<style>
@import "nprogress/nprogress";
</style>
