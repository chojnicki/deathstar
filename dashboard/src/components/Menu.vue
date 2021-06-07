<template>
  <nav
    class="fixed z-20 left-0 top-0 h-screen w-20 pt-20 flex flex-col
      border-r border-opacity-30 bg-blue bg-opacity-95"
  >
    <MenuItem :name="'dashboard'">
      <mdi-home />
    </MenuItem>
    <MenuItem :name="'people.index'">
      <mdi-view-list />
    </MenuItem>
    <MenuItem :name="'demo'">
      <mdi-chart-timeline-variant />
    </MenuItem>
    <MenuItem
      :name="'demo3'"
      :notified="true"
    >
      <mdi-email />
    </MenuItem>
    <MenuItem :name="'404'">
      <mdi-account-multiple />
    </MenuItem>
  </nav>
</template>

<script setup lang="ts">
import MenuItem from '@/components/MenuItem.vue'
</script>
