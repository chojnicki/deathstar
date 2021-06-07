<template>
  <div class="grid gap-6 grid-cols-3">
    <DataTable
      class="col-span-3"
      :data="restPaginated.state.data"
      :columns="columns"
      :placeholder-items="restPaginated.state.perPage"
    >
      <template #actions="slotProps">
        <router-link
          :to="{ name: 'people.edit', params: {
            id: slotProps.id
          }}"
        >
          <mdi-square-edit-outline /> Edit
        </router-link>
        <button @click="onDeleteClick(slotProps.id)">
          <mdi-trash-can-outline /> Delete
        </button>
      </template>
    </DataTable>

    <div class="col-span-3 flex justify-between items-center mb-3">
      <button
        class="btn"
        :disabled="!restPaginated.getters.isPrevPage"
        @click="restPaginated.prevPage()"
      >
        <mdi-chevron-left class="inline text-2xl" />
        <span class="hidden sm:inline">Previous page</span>
      </button>
      <span class="text-base">
        Total: {{ restPaginated.state.totalItems }}
      </span>
      <button
        class="btn"
        :disabled="!restPaginated.getters.isNextPage"
        @click="restPaginated.nextPage()"
      >
        <span class="hidden sm:inline">Next page</span>
        <mdi-chevron-right class="inline text-2xl" />
      </button>
    </div>

    <Card
      v-for="i in 3"
      :key="i"
      class="col-span-3 md:col-span-1 p-6"
    >
      Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat aspernatur, id a,
      ratione aperiam quo soluta at incidunt corrupti ipsum accusamus explicabo voluptatibus
      fugiat assumenda similique consequuntur hic voluptate voluptatum?
    </Card>
  </div>
</template>

<script setup lang="ts">
import { onMounted } from 'vue'
import Card from '@/components/Card.vue'
import DataTable from '@/components/DataTable.vue'
import { http, getErrorMessage } from '@/http'
import { useToast } from 'vue-toastification'
import { useLoading } from '@/loading'
import { useRestPaginated } from '@/rest-paginated'

const columns = [
  { name: 'id', title: 'ID' },
  { name: 'name', title: 'Name' },
  { name: 'gender', title: 'Gender' },
  { name: 'planet.name', title: 'Planet' },
  { name: 'actions', title: 'Actions' },
]

const restPaginated = useRestPaginated('api/people')
const toast = useToast()
const loading = useLoading()

const fetchPeople = () => {
  restPaginated.fetchData()
    .catch((err) => toast.error(`Cannot fetch people. ${getErrorMessage(err)}`))
}
onMounted(fetchPeople)

const onDeleteClick = (id: number) => {
  // TODO js prompt
  loading.start()
  http.delete(`/api/people/${id}`)
    .then(() => toast.success('Person deleted successfully'))
    .catch((err) => toast.error(`Cannot delete person. ${getErrorMessage(err)}`))
    .finally(() => {
      loading.end()
      fetchPeople()
    })
}
</script>
