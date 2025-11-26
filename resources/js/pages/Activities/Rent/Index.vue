<template>
    <h1 class="text-2xl text-slate-600 font-medium mb-4 text-center">
        Your Bookings Made
    </h1>
    <div class="mb-4 font-medium text-gray-500">You have made {{ bookings.data.length }} booking(s) so far</div>
    <section v-if="bookings.data.length" class="grid grid-cols-1 lg:grid-cols-2 gap-2">
        
  <Bookings v-for="booking in bookings.data" :key="booking.id" :booking="booking" />


    </section>
    <EmptyState class="mt-16 \" v-else>
    No bookings made yet
   
    
</EmptyState>
<div v-if="bookings.data.length" class="w-full flex justify-center mt-4 mb-4">
<Pagination :links="bookings.links" />
</div>
    </template>

<script setup lang="ts" >
import {Link} from '@inertiajs/vue3'

const props = defineProps({
  bookings: Object
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
import Bookings from './Components/Bookings.vue';


export default {
  layout: MainLayout,
  
}
</script>