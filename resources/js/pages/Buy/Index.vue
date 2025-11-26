<template>
  <Filter :filters="filters" />
  
  
<div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 ">
    <Buy v-for="buy in buys.data" :key="buy.id" :buy="buy"
    />
   </div>
   <div v-if="buys.data.length" class="w-full flex justify-center mt-4 mb-4">
    <Pagination :links="buys.links" />
  </div>

    </template>


<script setup lang="ts">
//import {useForm} from  '@inertiajs/vue3'
import Buy from '@/pages/Buy/Components/Buy.vue';
import Filter from '@/pages/Buy/Components/Filter.vue';
defineProps({buys: Object, filters: Object})

</script>


<script lang="ts">
import MainLayout from '@/layouts/MainLayout.vue';
import Pagination from '@/components/Pagination.vue'



export default {
  layout: MainLayout,
  
}
</script>