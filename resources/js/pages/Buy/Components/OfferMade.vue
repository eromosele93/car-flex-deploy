<template>
    <Box>
        <h1 class="text-xl font-bold text-slate-500 text-center mb-4">Offer Made</h1>

        <Price :price="offer.amount" class="text-4xl"/>
        <section class="flex flex-col md:flex-row justify-between text-gray-500">
        <div>Made On</div>
            <div class="font-medium">{{ offerMadeOn }}</div>

        </section>
        </Box>
        </template>
    
        <script setup lang="ts">
     import Price from '@/components/Price.vue';
import Box from '@/components/ui/Box.vue'
import { computed } from 'vue';
     const props = defineProps({
        offer: Object
     })
const offerMadeOn = computed(
    () => new Date(props.offer.created_at).toDateString(),
)
    </script>