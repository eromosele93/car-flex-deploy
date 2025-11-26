<template>
    <Box>

<div class="text-sm font-bold text-slate-500  mb-2">Booking #{{ booking.id }}</div>

<section >
    <Rate :rate="props.listingRate" class="text-xl" />

    <div class="flex justify-between">
        <div class="text-left">

<div class="text-sm font-medium text-slate-500">Booking Amount:</div>
<div class="font-medium text-sm text-slate-500">Start Date:</div>
<div class="font-medium text-sm text-slate-500">End Date:</div>
<div class="font-medium text-sm text-slate-500">Made By:</div>
<div class="font-medium text-sm text-slate-500">Made On:</div>
</div>
<div class="text-right">

    
<Rate2 class="font-medium text-slate-500 text-sm" :rate="booking.amount" />
<div class="font-medium text-slate-500 text-sm">{{ booking.start_date }}</div>
<div class="font-medium text-slate-500 text-sm">{{ booking.end_date }}</div>
<div class="font-medium text-slate-500 text-sm">{{ booking.renter.name }}</div>
<div class="font-medium text-slate-500 text-sm">{{ offerMadeOn }}</div>
</div>
    </div>
<div v-if="booking.status === 'pending'" class="flex justify-center gap-2">
<Link method="put" as="button" class="btn-2" :href="route('booking.confirm', {booking: booking.id})">Confirm</Link>
<Link method="put" as="button" class="btn-2" :href="route('booking.decline', {booking: booking.id})">Decline</Link>

</div>
<div class="text-center font-bold text-blue-500" v-else-if="booking.status === 'confirmed'">
Confirmed
</div>
<div class="text-center font-bold text-green-500" v-else-if="booking.status === 'completed'">
Completed
</div>
<div class="text-center font-bold text-red-500" v-else-if="booking.status === 'cancelled'">
Cancelled by {{ booking.renter.name }}
</div>
<div class="text-center font-bold text-red-500" v-else-if="booking.status === 'declined'">
Declined by You
</div>

</section>
</Box>
</template>

<script setup lang="ts">

import Rate from '@/components/Rate.vue';
import Rate2 from '@/components/Rate2.vue';
import Box from '@/components/ui/Box.vue';
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';


const offerMadeOn = computed(
    () => new Date(props.booking.created_at).toDateString()
)

const props = defineProps({
booking: Object,
listingRate: Number
});
</script>