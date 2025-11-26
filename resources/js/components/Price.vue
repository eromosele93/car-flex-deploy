<template>
    <div class=" ">{{ formattedPrice }}</div>
    </template>
    <script setup lang="ts">
    import {computed} from 'vue'
 const props = defineProps({
price: [Number, String],
 })
 const formattedPrice  = computed(
    () => Number(props.price).toLocaleString('en-US', {
    style: 'currency',
    currency: 'GBP',
    maximumFractionDigits: 0,
  }),
 )
    </script>
    