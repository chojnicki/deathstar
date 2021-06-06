<template>
  <div class="fixed top-0 left-0">
    <div class="absolute z-20 w-screen h-screen p-6 flex flex-col items-center justify-center">
      <SvgLogo
        width="350"
        height="150"
        fill="white"
        class="max-w-full"
      />
      <Card class="max-w-lg mt-8">
        <slot />
      </Card>
    </div>
    <StarsParallax />
  </div>
</template>

<script setup lang="ts">
import { useAuthStore } from '@/stores/auth'
import StarsParallax from '@/components/StarsParallax.vue'
import SvgLogo from '@/assets/images/logo.svg'
import Card from '@/components/Card.vue'

const auth = useAuthStore()

auth.refreshCsrf()
</script>
