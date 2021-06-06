<template>
  <div>
    Demo Lorem ipsum dolor sit amet consectetur, adipisicing elit.
    Nulla quisquam eum sapiente perferendis explicabo. Necessitatibus omnis,
    tempora officiis cupiditate ipsa delectus. Non ullam eveniet, aspernatur
    assumenda omnis et doloremque asperiores.

    <Card class="w-96 p-6">
      Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat aspernatur, id a,
      ratione aperiam quo soluta at incidunt corrupti ipsum accusamus explicabo voluptatibus
      fugiat assumenda similique consequuntur hic voluptate voluptatum?
    </Card>

    <button class="btn m-6">
      Test
    </button>

    <button class="btn btn-outline m-6">
      Test
    </button>

    <input
      type="text"
      class="form-input"
      placeholder="test"
    >

    <label class="my-2 flex items-center">
      <input
        type="checkbox"
        class="form-checkbox"
      >
      <span class="ml-2">Test test test</span>
    </label>
  </div>
</template>

<script setup lang="ts">
import Card from '@/components/Card.vue'
</script>
