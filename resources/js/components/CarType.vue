<template>

    <div class="text-slate-700 gap-2">
        <div class="font-bold">Colour: {{ buy.colour }} </div> 
     <div class="font-bold">Type: {{ buy.type }}</div> 
     <div class="font-bold ">{{ buy.category }}</div>
    </div>
   
    </template>

<script setup lang="ts">
defineProps({buy: Object})
</script>