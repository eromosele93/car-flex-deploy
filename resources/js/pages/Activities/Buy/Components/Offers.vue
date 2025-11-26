<template>
          <Box>
            <div class="text-slate-500 font-bold text-lg">Offer #{{ offer.id }}</div>
<div class="flex justify-between mb-4">
    <div class="text-left">
<div class="font-medium text-sm text-slate-500">Offer Amount:</div>
<div class="font-medium text-sm text-slate-500">Made On:</div>
<div v-if="offer.accepted_at" class="font-medium text-sm text-slate-500">Accepted at:</div>
<div v-if="offer.rejected_at" class="font-medium text-sm text-slate-500">Rejected at:</div>
<div class="font-medium text-sm text-slate-500">Status:</div>
</div>

<div class="text-right">
<Price :price="offer.amount" class="text-sm font-medium text-slate-500" />
<div class="text-sm font-medium text-slate-500">{{offerMadeOn}}:</div>
<div v-if="offer.accepted_at" class="font-medium text-sm text-slate-500">{{ accepted_at }}</div>
<div v-if="offer.rejected_at" class="font-medium text-sm text-slate-500">{{ rejected_at }}</div>
<div v-if="!offer.accepted_at && !offer.rejected_at" class="font-medium text-sm text-blue-500">Pending</div>
<div v-else-if="offer.accepted_at"  class="font-medium text-sm text-green-500">Offer Accepted</div>
<div v-else-if="offer.rejected_at"  class="font-medium text-sm text-red-500">Offer Rejected</div>
</div>

</div>
<div class="flex justify-center">
    <Link as="button" method="delete" class="btn-2 " v-if="!offer.accepted_at && !offer.rejected_at" :href="route('offers-made.destroy', {offers_made: offer.id})"> Cancel Offer</Link>
</div>

</Box>
</template>

<script setup lang="ts">
import Price from '@/components/Price.vue';
import Box from '@/components/ui/Box.vue';
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
offer: Object,
});

const offerMadeOn = computed(
    () => new Date(props.offer.created_at).toDateString()
)

const accepted_at = computed(
    () => new Date(props.offer.accepted_at).toDateString()
)
const rejected_at = computed(
    () => new Date(props.offer.rejected_at).toDateString()
)


</script>