<template>
  <template v-if="route.matched.length">
    <transition
      enter-active-class="animate__animated animate__fadeIn"
      leave-active-class="animate__animated animate__fadeOut"
    >
      <component :is="layouts[currentLayout]">
        <router-view v-slot="{ Component }">
          <transition
            enter-active-class="animate__animated animate__fadeInLeft"
            leave-active-class="hidden"
          >
            <suspense timeout="0">
              <component
                :is="Component"
                v-if="Component"
              />
              <template #fallback>
                <span>Loading... TODO</span>
              </template>
            </suspense>
          </transition>
        </router-view>
      </component>
    </transition>
  </template>
</template>

<script setup lang="ts">
import { computed } from 'vue'
import type { Component } from 'vue'
import { useRoute } from 'vue-router'
import LayoutDefault from '@/layouts/Default.vue'
import LayoutAuth from '@/layouts/Auth.vue'

const route = useRoute()

const layouts: Record<string, Component> = {
  default: LayoutDefault,
  auth: LayoutAuth,
}

const currentLayout = computed(() => route.meta.layout as string || 'default')

</script>

<style lang="postcss">
@import "@/styles/index.css";

#app {
  @apply text-white min-h-screen font-sans bg-blue-dark bg-repeat-x bg-fixed;
  /* fix gradient banding by dither - I know it sucks that it's png, but small one ;) */
  background-image: url('@/assets/images/bg.png'); /* inline after build */
}
</style>
