<template inherit-attrs="false">
  <router-link
    :to="{ name }"
    class="flex w-full py-4 my-2 items-center justify-center"
    @click="layout.setMenuVisibility(false)"
  >
    <span
      class="flex w-full h-full justify-center text-white
        opacity-50 hover:opacity-100 transition-opacity"
    >
      <slot />

    </span>
    <div
      v-if="notified"
      data-test="menu-notified-circle"
      class="absolute w-2 h-2 bg-red rounded-full ml-8 -mt-6 glow"
    />
  </router-link>
</template>

<script setup lang="ts">
import { defineProps } from 'vue'
import { useLayoutStore } from '@/stores/layout'

const layout = useLayoutStore()

defineProps({
  name: {
    type: String,
    required: true,
  },
  notified: { // round circle above icon
    type: Boolean,
    default: false,
  },
})
</script>

<style lang="postcss" scoped>
a {
  &.router-link-active {
    span {
      @apply opacity-100;
    }
  }

  &:deep(svg)  {
    @apply w-8 h-auto;
  }
}
</style>
