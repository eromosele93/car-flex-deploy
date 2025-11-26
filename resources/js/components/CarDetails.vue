<template>

    <div class="text-slate-700 flex gap-2">
        <div class="font-bold">{{ buy.year }} </div> 
     <div class="font-bold">{{ buy.brand }}</div> 
     <div class="font-bold">{{ buy.model }}</div>  
   
    </div>
    </template>

<script setup lang="ts">
defineProps({buy: Object})
</script>