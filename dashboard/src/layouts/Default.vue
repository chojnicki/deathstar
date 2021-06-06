<template>
  <div class="w-full min-h-screen p-6 md:pl-28 pt-28">
    <Header />
    <transition
      enter-active-class="animate__animated animate__slideInLeft"
      leave-active-class="animate__animated animate__slideOutLeft"
    >
      <Menu v-if="layout.state.menuExpanded" />
    </transition>
    <slot />
  </div>
</template>

<script setup lang="ts">
import { useAuthStore } from '@/stores/auth'
import { useLayoutStore } from '@/stores/layout'
import { useRouter } from 'vue-router'
import Header from '@/components/Header.vue'
import Menu from '@/components/Menu.vue'

const auth = useAuthStore()
const layout = useLayoutStore()
const router = useRouter()

auth.refreshCsrf()
auth.refreshUserData()
  .catch((error) => {
    if (error.response?.status === 401) {
      router.push({ name: 'login' })
    }
  })
</script>
