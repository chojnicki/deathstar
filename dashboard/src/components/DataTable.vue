<template>
  <div class="w-full overflow-x-auto">
    <table class="w-full border-separate border-spacing-y-4">
      <thead>
        <tr>
          <th
            v-for="(column, index) in columns"
            :key="index"
            class="font-normal text-base text-left pl-4 md:pl-5"
            :class="{ 'w-48': column.name === 'actions' }"
          >
            {{ column.title }}
          </th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="(item, key) in (data || Array(placeholderItems))"
          :key="key"
          class="bg-black bg-opacity-20"
        >
          <td
            v-for="(column, index) in columns"
            :key="index"
            class="p-4 md:p-5"
            :class="{
              'border-l-4 border-red rounded-l-md': index === 0,
              'rounded-r-md': index === columns.length -1,
            }"
          >
            <span v-if="!item">&nbsp;</span>
            <span
              v-else-if="column.name === 'actions'"
              class="table-actions"
            >
              <slot
                :id="item.id"
                name="actions"
                class="table-actions"
              />
            </span>
            <span v-else>
              {{ get(item, column.name) || 'unknown' }}
            </span>
          </td>
        </tr>
        <tr
          v-if="data && !data.length"
          class="bg-black bg-opacity-20"
        >
          <td
            :colspan="columns.length"
            class="px-4 md:px-5 py-8 rounded-md border-l-4 border-red text-center text-lg"
          >
            <slot name="empty">
              <mdi-alert-circle-outline class="inline-block text-4xl" /> No data found
            </slot>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup lang="ts">
import { defineProps } from 'vue'
import type { PropType } from 'vue'
import { get } from 'lodash'

type ColumnType = {
  name: string,
  title: string,
}

type DataItemType = {
  id: number,
  [key: string]: string | number | null
}

defineProps({
  columns: {
    type: Object as PropType<ColumnType[]>,
    required: true,
  },
  data: {
    type: [Array, null] as PropType<DataItemType[] | null>,
    requred: true,
  },
  placeholderItems: {
    type: Number,
    default: 10,
  },
})
</script>

<style lang="postcss">
.table-actions {
  @apply flex;

  a, button {
    @apply flex items-center hover:opacity-70 transition-opacity mr-2;

    svg {
      @apply mr-1;
    }
  }
}
</style>
