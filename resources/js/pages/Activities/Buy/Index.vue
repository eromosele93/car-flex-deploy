<template>
    <h1 class="text-2xl text-slate-600 font-medium mb-4 text-center">
        Your Offers Made
    </h1>
    <div class="mb-4 font-medium text-gray-500">You have made {{ offers.data.length }} offer(s) so far</div>
    <section v-if="offers.data.length" class="grid grid-cols-1 lg:grid-cols-2 gap-2">
        
  <Offers v-for="offer in offers.data" :key="offer.id" :offer="offer" />


    </section>
    <EmptyState class="mt-16 \" v-else>
    No offers made yet
   
    
</EmptyState>
<div v-if="offers.data.length" class="w-full flex justify-center mt-4 mb-4">
<Pagination :links="offers.links" />
</div>
    </template>

<script setup lang="ts" >
import {Link} from '@inertiajs/vue3'

const props = defineProps({
  offers: Object
});


</script>
<script lang="ts">
import MainLayout from '@/layouts/MainLayout.vue';
import EmptyState from '@/components/ui/EmptyState.vue'
import CarDetails from '@/components/CarDetails.vue'
   import Box from '@/components/ui/Box.vue'
import Price from '@/components/Price.vue'
import CarType from '@/components/CarType.vue'
import Pagination from '@/components/Pagination.vue'
import { computed } from 'vue';
import Offers from './Components/Offers.vue';


export default {
  layout: MainLayout,
  
}
</script>