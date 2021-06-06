<template>
  <header
    class="fixed left-0 top-0 z-30 w-screen h-20 flex items-center
      border-b border-opacity-30 bg-blue bg-opacity-95"
  >
    <div class="flex-none w-20 h-full border-r">
      <button
        data-test="header-logo"
        class="w-full h-full flex flex-none items-center justify-center"
        @click="onLogoClick"
      >
        <SvgLogo
          width="56"
          height="24"
          fill="white"
        />
      </button>
    </div>
    <div class="flex-1 flex justify-end items-center pl-12 pr-6">
      <div class="hidden md:flex items-center mr-auto">
        <mdi-search class="w-9 h-auto" />
        <input
          type="text"
          class="form-input ml-2 border-none w-80 placeholder-white"
          placeholder="Search payment, transaction, rebels..."
        >
      </div>
      <button
        class="btn btn-outline hidden sm:flex items-center"
        @click="onAddClick"
      >
        Add <mdi-plus class="ml-2" />
      </button>

      <button
        data-test="header-notifications"
        class="ml-6"
        @click="notifications = false"
      >
        <mdi-bell-outline class="w-8 h-auto" />
        <div
          v-if="notifications"
          class="absolute w-2 h-2 bg-red rounded-full ml-5 -mt-6 glow"
        />
      </button>

      <button
        data-test="header-user"
        class="ml-6 flex items-center hover:opacity-80 transition-opacity"
        @click="onLogoutClick"
      >
        <img
          src="@/assets/images/avatar-demo.jpg"
          alt="avatar"
          width="50"
          height="50"
          class="bg-black rounded-full"
        >

        <mdi-expand-more class="hidden sm:block ml-2 w-6 h-auto" />
      </button>
    </div>
  </header>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import { useAuthStore } from '@/stores/auth'
import { useLayoutStore } from '@/stores/layout'
import { useRouter } from 'vue-router'
import { useToast } from 'vue-toastification'
import SvgLogo from '@/assets/images/logo.svg'

const auth = useAuthStore()
const layout = useLayoutStore()
const router = useRouter()
const toast = useToast()

const notifications = ref(true) // TODO

const onLogoutClick = () => {
  auth.logout()
  router.push({ name: 'login' })
  toast.success('Hail the Empire!')
}

const onLogoClick = () => {
  if (window.innerWidth < 768) {
    layout.toggleMenuVisibility()
  } else {
    layout.setMenuVisibility(true) // to be sure
    router.push('/')
  }
}

const onAddClick = () => {
  const rand = Math.floor(Math.random() * 3)
  const toasts = [
    () => toast.warning('Demo warning toast'),
    () => toast.success('Demo success toast'),
    () => toast.error('Demo error toast'),
  ]
  toasts[rand]()
}

</script>
