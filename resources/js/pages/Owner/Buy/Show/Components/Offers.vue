<template>
    <Box>

<div class="text-sm font-bold text-slate-500  mb-2">Offer #{{ offer.id }} <span class="text-white rounded-md uppercase ml-2 p-1 bg-green-500" v-if="offer.accepted_at">Accepted</span>
<span class="text-white uppercase ml-2 rounded-md bg-red-500 p-1" v-else-if="offer.rejected_at">rejected</span>
</div>

<section class="flex justify-between">
<div class="text-left">
<Price :price="offer.amount" class="text-xl" />
<div class="text-sm font-medium text-slate-500">Difference:</div>
<div class="font-medium text-sm text-slate-500">Made By:</div>
<div class="font-medium text-sm text-slate-500">Made On:</div>
</div>
<div class="text-right">

    <Link v-if="!offer.accepted_at && !offer.rejected_at" method="put" :href="route('offer.accept', {offer: offer.id})" class="btn-outline text-sm" as="button">
Accept
</Link>
<div v-else class="text-slate-500 font-bold ">Sold</div>
<Price :price="difference" class="font-medium mt-2 text-sm text-slate-500" />
<div class="text-slate-500 text-sm">{{ offer.bidder.name }}</div>
<div class="text-slate-500 text-sm">{{ offerMadeOn }}</div>
</div>

</section>
</Box>
</template>

<script setup lang="ts">
import Price from '@/components/Price.vue';
import Box from '@/components/ui/Box.vue';
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const difference = computed(
  () => props.offer.amount - props.listingPrice,
)
const offerMadeOn = computed(
    () => new Date(props.offer.created_at).toDateString()
)

const props = defineProps({
offer: Object,
listingPrice: Number
});
</script>