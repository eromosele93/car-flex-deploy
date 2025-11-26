<template>
 <Box>
    <Link :href="route('buy.show', {buy: buy.id})">
<div class="md:flex gap-4">
    <div v-if="buy.buy_images.length">
        <img class="rounded-md" :src="buy.buy_images[0]?.src" alt="">
    </div>
    <div v-else class="rounded-md h-52 md:h-28 md:w-32 border border-gray-800 text-slate-500 text-center ">
        No Image
    </div>
    <div class="mt-4 md:mt-0">
        <CarDetails :buy="buy"  class="text-sm"/>
   
    <CarType :buy="buy" class="text-sm"/>
    
    <Price :price="buy.price" class="text-lg font-bold"/>
    
</div>

</div>
</Link>

</Box>
    </template>
   <script setup lang="ts">
 import { Link } from '@inertiajs/vue3'
 import { route } from 'ziggy-js'
   import CarDetails from '@/components/CarDetails.vue'
   import Box from '@/components/ui/Box.vue'
import Price from '@/components/Price.vue'
import CarType from '@/components/CarType.vue'



   defineProps({buy: Object})
   </script>

   