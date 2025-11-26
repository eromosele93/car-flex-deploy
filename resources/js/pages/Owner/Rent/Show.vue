<template>

    <div class="mb-4">
        <Link 
          :href="route('owner-rent.index')"
        >
          ← Go back to Listings
        </Link>
        </div>
        <section class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4">
        <Box v-if="!hasBookings" class="flex md:col-span-7 items-center">
          <div class="w-full text-center font-medium text-gray-500">
            No Bookings yet
          </div>
        </Box>
    
        <div v-else class="md:col-span-7 items-center">
         
          
    <Booking class="mb-4" v-for="booking in rent.bookings" :booking="booking" :key="booking.id" :listing-rate="rent.rate"/>
            
        
        </div>
    <div class="md:col-span-5">
        <Box >
            <div class="text-xl font-bold text-slate-500 text-center mb-4">Basic Info</div>
          <Rate :rate="rent.rate" class="text-2xl font-bold" />
    
          <CarDetails :buy="rent"  class="text-sm"/>
       
        <CarType :buy="rent" class="text-sm"/>
        </Box>
    </div>
        
      </section>
    </template>
    
    
    
    <script setup lang="ts">
    import {Link} from '@inertiajs/vue3'
    
    const props = defineProps({
      rent: Object
    })
    const hasBookings = computed(
      () => props.rent.bookings.length,
    )
    </script>
    <script lang="ts">
    import MainLayout from '@/layouts/MainLayout.vue';
    import CarDetails from '@/components/CarDetails.vue'
    import Box from '@/components/ui/Box.vue'
    import Rate from '@/components/Rate.vue'
    import CarType from '@/components/CarType.vue'
    import Pagination from '@/components/Pagination.vue'
    import { computed } from 'vue';
    import Booking from './Show/Component/Booking.vue';
    export default {
      layout: MainLayout,
      
    }
    </script>