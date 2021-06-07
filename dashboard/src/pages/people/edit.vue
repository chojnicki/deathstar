<template>
  <div class="grid gap-6 grid-cols-3">
    <Card class="col-span-3 md:col-span-1">
      <div class="p-4 border-b border-opacity-50">
        <h1 class="text-center text-xl uppercase">
          <mdi-account-details class="inline text-2xl mr-2" /> Person Details
        </h1>
      </div>
      <div class="p-4 border-b border-opacity-50">
        <div
          v-for="(input, key) in inputs"
          :key="key"
          class="my-3"
        >
          <label class="block pl-3 mb-1 font-semibold">
            {{ input.title }}:
          </label>
          <input
            v-model.lazy="data[input.name]"
            :type="input.type"
            class="form-input w-full"
            :placeholder="`${input.title}...`"
          >
        </div>
      </div>
      <div class="p-4">
        <button
          class="btn w-full"
          @click="onSaveClick"
        >
          Save <mdi-content-save-edit-outline class="inline text-lg ml-2" />
        </button>
      </div>
    </Card>

    <Card class="col-span-3 md:col-span-1 p-6">
      <pre>{{ data }}</pre>
    </Card>

    <Card class="col-span-3 md:col-span-1 p-6">
      Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat aspernatur, id a,
      ratione aperiam quo soluta at incidunt corrupti ipsum accusamus explicabo voluptatibus
      fugiat assumenda similique consequuntur hic voluptate voluptatum?
    </Card>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import { useRoute } from 'vue-router'
import Card from '@/components/Card.vue'
import { http, getErrorMessage } from '@/http'
import { useLoading } from '@/loading'
import { useToast } from 'vue-toastification'

const route = useRoute()
const loading = useLoading()
const toast = useToast()

loading.start()
const data = ref()
data.value = (await http.get(`api/people/${route.params.id}`)).data.data
loading.end()

const inputs = [
  { name: 'name', type: 'text', title: 'Name' },
  { name: 'gender', type: 'text', title: 'Gender' },
  { name: 'height', type: 'number', title: 'Height' },
  { name: 'mass', type: 'number', title: 'Mass' },
  { name: 'hair_color', type: 'text', title: 'Hair color' },
  { name: 'skin_color', type: 'text', title: 'Skin color' },
  { name: 'born_at', type: 'number', title: 'Born at' },
  { name: 'died_at', type: 'number', title: 'Died at' },
]

const onSaveClick = () => {
  loading.start()
  http.patch(`api/people/${route.params.id}`, data.value)
    .then(() => toast.success('Person edited successfully'))
    .catch((err) => toast.error(getErrorMessage(err)))
    .finally(() => loading.end())
}
</script>
