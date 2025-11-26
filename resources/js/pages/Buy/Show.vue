<template>


<div class="flex flex-col-reverse md:grid md:grid-cols-12 gap-2">
<Box class=" md:col-span-7 flex items-center w-full">
    <div v-if="buy.buy_images.length" class="relative w-full">
  <img
    class="rounded-md w-full object-contain"
    :src="buy.buy_images[currentImageIndex].src"
    :alt="buy.buy_images[currentImageIndex].alt || 'Product Image'"
  />

  <!-- Image Number Indicator -->
  <div class="absolute top-2 right-2 bg-black bg-opacity-60 text-white text-sm px-2 py-1 rounded-md">
    {{ currentImageIndex + 1 }} / {{ buy.buy_images.length }}
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
    <CarDetails :buy="buy"  class="text-sm"/>

<CarType :buy="buy" class="text-sm"/>

<Price  :price="buy.price" class="text-lg font-bold"/>

</div>

</div> 
</Box>
<Box>
    <div class="text-xl font-bold text-slate-500 text-center mb-4">Monthly Payment</div>

    <label class="label"> Interest Rate: 5% per annum </label>
    <label class="label"> Duration ({{duration}} years) </label>
                <input v-model.number="duration"  type="range" min="1" max="10" step="1" class="w-full h-4 bg-gray-200 rounded-lg appearance-none
                 cursor-pointer dark:bg-gray-700"/>
    </Box>

    <div class="text-gray-600 mt-2 dark:text-gray-300">
                <div class="text-gray-400"> Your Monthly Repayment</div>
                 <Price :price="monthlyPayment" class="text-3xl"/> 
            </div>
            <div class="mt-2 text-gray-500 flex justify-between">
<div>Total Paid</div>
<div><Price :price="totalPaid" /></div>
            </div>
            <div class="mt-2 text-gray-500 flex justify-between">
<div>Principal Paid</div>
<div><Price :price="offer" /></div>
            </div>
            <div class="mt-2 text-gray-500 flex justify-between">
<div>Interest Paid</div>
<div><Price :price="totalInterest" /></div>
            </div>
       <MakeOffer v-if="!offerMade" @offer-updated="offer = $event"
        :buy-id="buy.id"
        :price="buy.price"/>    

        <OfferMade v-if="offerMade" :offer="offerMade"
        
        />
</div>

</div>

    

    </template>

<script setup lang="ts">
import {ref} from 'vue'
import { useMonthlyPayment } from '@/composables/useMontlyPayment'
const props = defineProps({buy: Object, offerMade: Object})


const interestRate = 5
const duration = ref(10)
const offer = ref(props.buy.price)

const {monthlyPayment, totalPaid, totalInterest}= useMonthlyPayment(offer, interestRate, duration)



const currentImageIndex = ref(0)

const nextImage = () => {
  if (props.buy.buy_images.length === 0) return
  currentImageIndex.value = (currentImageIndex.value + 1) % props.buy.buy_images.length
}

const prevImage = () => {
  if (props.buy.buy_images.length === 0) return
  currentImageIndex.value =
    (currentImageIndex.value - 1 + props.buy.buy_images.length) % props.buy.buy_images.length
}


</script>
<script lang="ts">
import MainLayout from '@/layouts/MainLayout.vue';
import Box from '@/components/ui/Box.vue'
import CarDetails from '@/components/CarDetails.vue'
import CarType from '@/components/CarType.vue'
import Price from '@/components/Price.vue'
import MakeOffer from './Components/MakeOffer.vue';
import OfferMade from './Components/OfferMade.vue';
export default {
  layout: MainLayout,
  
}
</script>