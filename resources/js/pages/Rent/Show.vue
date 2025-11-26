<template>
<div class="flex flex-col-reverse md:grid md:grid-cols-12 gap-2">
<Box class=" md:col-span-7 flex items-center w-full">

    <div v-if="rent.rent_images.length" class="relative w-full">
  <img
    class="rounded-md w-full  object-contain"
    :src="rent.rent_images[currentImageIndex].src"
    :alt="rent.rent_images[currentImageIndex].alt || 'Product Image'"
  />

  <!-- Image Number Indicator -->
  <div class="absolute top-2 right-2 bg-black bg-opacity-60 text-white text-sm px-2 py-1 rounded-md">
    {{ currentImageIndex + 1 }} / {{ rent.rent_images.length }}
  </div>

  <!-- Navigation Buttons -->
  <button
    class="absolute top-1/2 left-2 transform -translate-y-1/2 bg-white text-black px-2 py-1 rounded-full shadow"
    @click="prevImage"
  >
    ‹
  </button>
  <button
    class="absolute top-1/2 right-2 transform -translate-y-1/2 bg-white text-black px-2 py-1 rounded-full shadow"
    @click="nextImage"
  >
    ›
  </button>
</div>


    <div v-else  class="text-center w-full font-medium text-gray-500">No images</div>
</Box>

<div class=" md:col-span-5 flex flex-col gap-4">
    
<Box>
    <div class="text-xl font-bold text-slate-500 text-center mb-4">Description</div>
    <div class="md:flex gap-2">

<div class="mt-4 md:mt-0">
    <CarDetails :buy="rent"  class="text-sm"/>

<CarType :buy="rent" class="text-sm"/>

<Rate  :rate="rent.rate" class="text-lg font-bold"/>

</div>

</div> 
</Box>

<Booking :rate="rent.rate" :rent-id="rent.id"/>
 

         
</div>

</div>

</template>

<script setup lang="ts">
import {ref} from 'vue'
const props = defineProps({rent: Object})


const currentImageIndex = ref(0)

const nextImage = () => {
  if (props.rent.rent_images.length === 0) return
  currentImageIndex.value = (currentImageIndex.value + 1) % props.rent.rent_images.length
}

const prevImage = () => {
  if (props.rent.rent_images.length === 0) return
  currentImageIndex.value =
    (currentImageIndex.value - 1 + props.rent.rent_images.length) % props.rent.rent_images.length
}

</script>

<script lang="ts">
import MainLayout from '@/layouts/MainLayout.vue';
import Box from '@/components/ui/Box.vue'
import CarDetails from '@/components/CarDetails.vue'
import CarType from '@/components/CarType.vue'
import Rate from '@/components/Rate.vue'
import Booking from './Components/Booking.vue';
export default {
  layout: MainLayout,
  
}
</script>