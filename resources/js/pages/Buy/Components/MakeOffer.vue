<template>
<Box>
    <h1 class="text-xl font-bold text-slate-500 text-center mb-4">Make Offer</h1>

<div>
    <form @submit.prevent="makeOffer">
<input v-model.number="form.amount" type="text" class="input">
<input v-model.number="form.amount" type="range" :min="min" :max="max" step="1000" class="w-full h-4 bg-gray-200 rounded-lg appearance-none
                 cursor-pointer dark:bg-gray-700 mt-4"/>
                 {{ form.errors.amount }}
<button type="submit" class="btn-primary mt-4" >Make Offer</button>
    </form>
</div>
<div class="flex justify-between text-gray-500 mt-2">
<div>Difference</div>
<div>
    <Price :price="difference" />
</div>
</div>
    </Box>
    </template>

    <script setup lang="ts">
 import Box from '@/components/ui/Box.vue'
 import Price from '@/components/Price.vue'
import { useForm } from '@inertiajs/vue3'
import { computed, watch } from 'vue'
import {debounce} from 'lodash'
const props = defineProps({
buyId: Number,
price: Number
});

 const form = useForm({
amount: props.price
 });
 const difference = computed(() => form.amount - props.price);
const min = computed(() => Math.round(props.price / 2));
const max = computed(() => props.price * 2);

const  makeOffer = () => form.post(route('buy.offer.store', {buy: props.buyId}), {
    preserveScroll: true,
    preserveState: true,
});

const emit = defineEmits(['offerUpdated']);
watch(() => form.amount, debounce( (value) => emit('offerUpdated', value), 200), );
</script>