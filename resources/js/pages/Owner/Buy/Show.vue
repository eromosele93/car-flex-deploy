<template>

<div class="mb-4">
    <Link 
      :href="route('owner-buy.index')"
    >
      ← Go back to Listings
    </Link>
    </div>
    <section class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4">
    <Box v-if="!hasOffers" class="flex md:col-span-7 items-center">
      <div class="w-full text-center font-medium text-gray-500">
        No offers
      </div>
    </Box>

    <div v-else class="md:col-span-7 items-center">
     <Offers class="mb-4" v-for="offer in buy.offers" :offer="offer" :key="offer.id" :listing-price="buy.price"  />
      

        
    
    </div>
<div class="md:col-span-5">
    <Box >
        <div class="text-xl font-bold text-slate-500 text-center mb-4">Basic Info</div>
      <Price :price="buy.price" class="text-2xl font-bold" />

      <CarDetails :buy="buy"  class="text-sm"/>
   
    <CarType :buy="buy" class="text-sm"/>
    </Box>
</div>
    
  </section>
</template>



<script setup lang="ts">
import {Link} from '@inertiajs/vue3'

const props = defineProps({
  buy: Object
})
const hasOffers = computed(
  () => props.buy.offers.length,
)
</script>
<script lang="ts">
import MainLayout from '@/layouts/MainLayout.vue';
import CarDetails from '@/components/CarDetails.vue'
import Box from '@/components/ui/Box.vue'
import Price from '@/components/Price.vue'
import CarType from '@/components/CarType.vue'
import Pagination from '@/components/Pagination.vue'
import { computed } from 'vue';
import Offers from './Show/Components/Offers.vue';
export default {
  layout: MainLayout,
  
}
</script>