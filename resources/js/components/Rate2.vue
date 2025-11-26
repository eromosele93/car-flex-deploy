<template>
    <div>{{ formattedPrice }}</div>
    </template>
    <script setup lang="ts">
    import {computed} from 'vue'
 const props = defineProps({
rate: [Number, String],
 })
 const formattedPrice  = computed(
    () => Number(props.rate).toLocaleString('en-US', {
    style: 'currency',
    currency: 'GBP',
    maximumFractionDigits: 0,
  }),
 )
    </script>
    