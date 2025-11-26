<template>

    <h1 class="text-2xl text-slate-600 font-medium mb-4 text-center">
        Your Rental Listings
    </h1>
   
    <section v-if="rents.data.length" class="grid grid-cols-1 lg:grid-cols-2 gap-2">
    <Box v-for="rent in rents.data" :key="rent.id" >
      <div :class="{'opacity-25' : rent.deleted_at}">
        <div class="flex flex-col md:flex-row gap-2 md:items-center justify-between">
            <CarDetails :buy="rent"  class="text-sm"/>
   
   <CarType :buy="rent" class="text-sm"/>
   
   <Rate :rate="rent.rate" class="text-lg font-bold"/>

  

            </div>
            <section>
            <div class="flex justify-center mt-4 items-center gap-1 text-gray-600 dark:text-gray-300">
            <a :href="route('rent.show', {rent: rent.id})"
            target="_blank" class="w-full btn-outline text-center text-xs font-medium">Preview</a>
            <Link :href="route('owner-rent.edit', {owner_rent: rent.id})" class="btn-outline w-full text-center text-xs font-medium">Edit</Link>
         
              <Link v-if="!rent.deleted_at" :href="route('owner-rent.destroy', {owner_rent: rent.id})" as="button" method="delete" class="btn-outline w-full text-xs font-medium">Delete</Link>
           
            <Link v-else  class="btn-outline w-full text-center text-xs font-medium" as="button" method="put" :href="route('owner-rent.restore',  {owner_rent: rent.id})" >Restore</Link>
        </div>
        <div class="mt-2">
            <Link class="btn-outline text-xs font-medium w-full block items-center text-center" :href="route('rent.images.create', {rent: rent.id})">Images({{ rent.rent_images_count}})</Link>
        </div>
        <div class="mt-2">
            <Link :href="route('owner-rent.show', {owner_rent: rent.id})" class="btn-outline text-xs font-medium w-full block items-center text-center" >Bookings ({{ rent.bookings_count }})</Link>
        </div>
        </section> 
        </div>
    </Box>

</section>
<EmptyState class="mt-16 \" v-else>
    No Listings yet
    <div><Link class="underline text-blue-500" :href="route('owner-rent.create')">Create listing</Link></div>
    
</EmptyState>

<div v-if="rents.data.length" class="w-full flex justify-center mt-4 mb-4">
    <Pagination :links="rents.links" />
  </div>
    </template>

<script setup lang="ts">
import {Link} from '@inertiajs/vue3'

defineProps({
  rents: Object
})
</script>
<script lang="ts">
import MainLayout from '@/layouts/MainLayout.vue';
import EmptyState from '@/components/ui/EmptyState.vue'
import CarDetails from '@/components/CarDetails.vue'
   import Box from '@/components/ui/Box.vue'
import Rate from '@/components/Rate.vue'
import CarType from '@/components/CarType.vue'
import Pagination from '@/components/Pagination.vue'
export default {
  layout: MainLayout,
  
}
</script>