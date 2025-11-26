<template>

<h1 class="text-3xl mb-4 text-center">
Your Notifications
</h1>

<section v-if="notifications.data.length" class="text-gray-700 ">
<div v-for="notification in notifications.data" :key="notification.id" 
class="border-b border-gray-200 py-4 flex justify-between items-center">
<div>
    <span 
  v-if="notification.type === 'App\\Notifications\\OfferMade'" 
  class="flex flex-wrap items-center gap-x-1 gap-y-1 text-sm sm:text-base"
>
  <span>Offer</span> 
  <Price :price="notification.data.amount" />
  <span>was made for</span>
  <Link 
    :href="route('owner-buy.show', { owner_buy: notification.data.buy_id })" 
    class="text-indigo-500 hover:underline"
  >
    Listing
  </Link>
</span>

<span v-if="notification.type === 'App\\Notifications\\BookingMade'" 
class="flex flex-wrap items-center gap-x-1 gap-y-1 text-sm sm:text-base">


<span>Booking</span> 
  <Price :price="notification.data.amount" />
  <span>with start date {{ notification.data.start_date }}   was made for
    <Link 
    :href="route('owner-rent.show', {owner_rent: notification.data.rent_id})" 
    class="text-indigo-500 hover:underline"
  >
    Listing
  </Link>
  </span>
 
</span>

</div>

<div>
    <Link :href="route('notification.seen', {notification:notification.id})" as="button"
     method="put" v-if="!notification.read_at" class="btn-outline text-xs font-medium uppercase">
     Mark as read</Link>
</div>
</div>

</section>
<div v-else class="text-center">
<EmptyState>
    No unread notifications
</EmptyState>
</div> 

<div v-if="notifications.data.length" class="w-full flex justify-center mt-4 mb-4">
    <Pagination :links="notifications.links" />
  </div>
</template>

<script setup lang="ts">
defineProps({
    notifications: Object,
})
</script>
<script lang="ts">
import { Link, usePage } from '@inertiajs/vue3'
import Price from '@/components/Price.vue';
import Button from '@/components/ui/button/Button.vue';
import EmptyState from '@/components/ui/EmptyState.vue';
import MainLayout from '@/layouts/MainLayout.vue';
import Pagination from '@/components/Pagination.vue';
export default {
    layout: MainLayout,
    
  }
  </script>