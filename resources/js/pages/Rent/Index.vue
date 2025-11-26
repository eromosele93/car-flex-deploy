<template>
      <Filter :filters="filters" />
  <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 ">
    


    <Rent v-for="rent in rents.data" :key="rent.id" :rent="rent"
    />
 
   
   
 

   </div>
   <div v-if="rents.data.length" class="w-full flex justify-center mt-4 mb-4">
    <Pagination :links="rents.links" />
  </div>
        </template>
    
    
    <script setup lang="ts">
    import Rent from '@/pages/Rent/Components/Rent.vue';
    import Filter from '@/pages/Rent/Components/Filter.vue';
    defineProps({rents: Object, filters: Object})
    </script>
    <script lang="ts">
    import MainLayout from '@/layouts/MainLayout.vue';
    import Pagination from '@/components/Pagination.vue'
   
    export default {
      layout: MainLayout,
      
    }
    </script>