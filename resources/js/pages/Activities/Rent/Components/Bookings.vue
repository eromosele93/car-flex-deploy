<template>
    <Box>
      <div class="text-slate-500 font-bold text-lg">Booking #{{ booking.id }}</div>
<div class="flex justify-between mb-4">
<div class="text-left">
<div class="font-medium text-sm text-slate-500">Booking Amount:</div>
<div class="font-medium text-sm text-slate-500">Rate:</div>
<div class="font-medium text-sm text-slate-500">Duration:</div>
<div class="font-medium text-sm text-slate-500">Booking Made On:</div>
<div class="font-medium text-sm text-slate-500">Booking Start Date:</div>
<div class="font-medium text-sm text-slate-500">Booking End Date:</div>
<div class="font-medium text-sm text-slate-500">Status:</div>
</div>

<div class="text-right">
<Price :price="booking.amount" class="text-sm font-medium text-slate-500" />
<Rate class="text-sm font-medium text-slate-500" :rate="booking.rent.rate" />
<div class="text-sm font-medium text-slate-500">{{duration}} Day(s)</div>
<div class="text-sm font-medium text-slate-500">{{bookingMadeOn}}:</div>
<div class="text-sm font-medium text-slate-500">{{start_date}}:</div>
<div class="text-sm font-medium text-slate-500">{{end_date}}:</div>
<div class="text-sm font-medium text-slate-500">{{booking.status}}</div>
</div>

</div>
<div class="flex justify-center">
<Link v-if="booking.status === 'pending'" as="button" method="put" class="btn-2 "  :href="route('bookings-made.update', {bookings_made: booking.id})"> Cancel Booking</Link>
</div>

</Box>
</template>

<script setup lang="ts">
import Price from '@/components/Price.vue';
import Rate from '@/components/Rate.vue';
import Box from '@/components/ui/Box.vue';
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
booking: Object,
});

const bookingMadeOn = computed(
() => new Date(props.booking.created_at).toDateString()
)
const start_date = computed(
() => new Date(props.booking.start_date).toDateString()
)
const end_date = computed(
() => new Date(props.booking.end_date).toDateString()
)

const duration = computed(() => {
 

  const start = new Date(props.booking.start_date)
  const end = new Date(props.booking.end_date);

  const diff = (end - start) / (1000 * 60 * 60 * 24); // ms to days

  return diff > 0 ? diff : 0;
});



</script>