
<template>
  <div class="border rounded-md bg-slate-100 p-6 md:p-12 mt-8">
    <p class="text-center text-xl md:text-2xl font-medium text-slate-700 mb-4">
      UK' Largest Car Dealership
    </p>

    <form
      class="bg-purple-400 border rounded-md p-6 md:p-10 flex flex-col md:flex-row md:justify-center md:items-center gap-4"
      @submit.prevent="search"
    >
      <input 
        v-model="searchForm.search"
        type="text"
        placeholder="Enter the brand of the car"
        class="p-2 rounded w-full md:w-64 text-sm"
      />
      
      <button
        type="submit"
        @click="setType('buy')"
        class="w-full md:w-20 bg-white text-purple-600 font-semibold py-2 px-4 rounded shadow hover:bg-purple-100 transition"
      >
        Buy
      </button>

      <button
        type="submit"
        @click="setType('rent')"
        class="w-full md:w-20 bg-white text-purple-600 font-semibold py-2 px-4 rounded shadow hover:bg-purple-100 transition"
      >
        Rent
      </button>
    </form>
  </div>
</template>

<script setup lang="ts">
import {useForm} from '@inertiajs/vue3'

const searchForm = useForm({
  search: null,
  type: null,
})

const search = () => {
  searchForm.get(route('cars.index'), {
    preserveState: true,
    preserveScroll: true,
  },)

 
}
const setType = (val: string) => {
  searchForm.type = val
}
</script>
<script lang="ts">
import MainLayout from '@/layouts/MainLayout.vue';
export default {
  layout: MainLayout,
  
}
</script>
