<template>
    <Box>
        <Link :href="route('rent.show', {rent: rent.id})">
   <div class="md:flex gap-2">
   
    <div v-if="rent.rent_images.length">
        <img class="rounded-md" :src="rent.rent_images[0]?.src" alt="">
    </div>
    <div v-else class="rounded-md h-52 md:h-28 md:w-32 border border-gray-800 text-slate-500 text-center ">
        No Image
    </div>
       <div class="mt-4 md:mt-0">
           <CarDetails :buy="rent"  class="text-sm"/>
      
    <CarType :buy="rent" class="text-sm"/>
       
       <Rate  :rate="rent.rate" class="text-lg font-bold"/>
       
   </div>
   
   </div>
</Link>
   
   </Box>
       </template>
      <script setup lang="ts">
     
      import CarDetails from '@/components/CarDetails.vue'
      import Box from '@/components/ui/Box.vue'
   import Rate from '@/components/Rate.vue'
   import CarType from '@/components/CarType.vue'
    import { Link } from '@inertiajs/vue3'
     
      defineProps({rent: Object})
      </script>
   
      