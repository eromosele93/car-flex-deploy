<template>

    <h1 class="text-2xl text-slate-600 font-medium mb-4 text-center">
        Your Sales Listings
    </h1>
   
    <section v-if="buys.data.length" class="grid grid-cols-1 lg:grid-cols-2 gap-2">
    <Box v-for="buy in buys.data" :key="buy.id" >
      <div :class="{'opacity-25' : buy.deleted_at}">
        <div v-if="buy.sold_at" class="text-xs font-bold uppercase text-green-500 border border-dashed border-green-300 p-1  rounded-md inline-block">Sold</div>
        <div class="flex flex-col md:flex-row gap-2 md:items-center justify-between">
            <CarDetails :buy="buy"  class="text-sm"/>
   
   <CarType :buy="buy" class="text-sm"/>
   
   <Price :price="buy.price" class="text-lg font-bold"/>

  

            </div>
            <section>
            <div class="flex justify-center mt-4 items-center gap-1 text-gray-600 dark:text-gray-300">
            <a :href="route('buy.show', {buy: buy.id})"
            target="_blank" class="w-full btn-outline text-center text-xs font-medium">Preview</a>
            <Link :href="route('owner-buy.edit',  {owner_buy: buy.id})" class="btn-outline w-full text-center text-xs font-medium">Edit</Link>
         
              <Link v-if="!buy.deleted_at" :href="route('owner-buy.destroy', {owner_buy: buy.id})" as="button" method="delete" class="btn-outline w-full text-xs font-medium">Delete</Link>
           
            <Link v-else  class="btn-outline w-full text-center text-xs font-medium" as="button" method="put" :href="route('owner-buy.restore', {owner_buy: buy.id})" >Restore</Link>
        </div>
        <div class="mt-2">
            <Link class="btn-outline text-xs font-medium w-full block items-center text-center" :href="route('buy.images.create', {buy: buy.id})">Images({{ buy.buy_images_count }})</Link>
        </div>
        <div class="mt-2">
            <Link  class="btn-outline text-xs font-medium w-full block items-center text-center" :href="route('owner-buy.show', {owner_buy: buy.id})"  >Offers({{ buy.offers_count }})</Link>
        </div>
        </section> 
        </div>
    </Box>

</section>
<EmptyState class="mt-16 \" v-else>
    No Listings yet
    <div><Link class="underline text-blue-500" :href="route('owner-buy.create')">Create listing</Link></div>
    
</EmptyState>

<div v-if="buys.data.length" class="w-full flex justify-center mt-4 mb-4">
    <Pagination :links="buys.links" />
  </div>
    </template>

<script setup lang="ts">
import {Link} from '@inertiajs/vue3'

defineProps({
  buys: Object
})
</script>
<script lang="ts">
import MainLayout from '@/layouts/MainLayout.vue';
import EmptyState from '@/components/ui/EmptyState.vue'
import CarDetails from '@/components/CarDetails.vue'
   import Box from '@/components/ui/Box.vue'
import Price from '@/components/Price.vue'
import CarType from '@/components/CarType.vue'
import Pagination from '@/components/Pagination.vue'
export default {
  layout: MainLayout,
  
}
</script>