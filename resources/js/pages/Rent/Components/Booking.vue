<template>
    <Box>
        <h1 class="text-xl font-bold text-slate-500 text-center mb-4">Make Booking</h1>
    
    <div>
        <form @submit.prevent="makeBooking">
            <label class="text-slate-500" for="start">Start Date:</label>
    <input class="input" type="date" id="start" v-model="form.start_date" />

    <label class="mt-2 text-slate-500" for="end">End Date:</label>
    <input class="input" type="date" id="end" v-model="form.end_date" />
    <button type="submit" class="btn-primary mt-4" >Make Booking</button>
        </form>
    </div>
    <div class="flex justify-between text-gray-500 mt-2">
    <div class="font-bold">Booking Amount</div>
    <div>
        <Rate2 class="font-bold" :rate="amount" />
    </div>
    
    </div>
    <div class="flex justify-between text-gray-500 mt-2">
    <div class="font-bold">Duration</div>
    <div>
        <div class="font-bold" >{{numberOfDays}} days </div>
    </div>
    
    </div>
        </Box>
        </template>
    
        <script setup lang="ts">
     import Box from '@/components/ui/Box.vue'
    import { useForm } from '@inertiajs/vue3'
    import { computed, watch } from 'vue'
import Rate2 from '@/components/Rate2.vue';
    const props = defineProps({
        rentId: Number,
        rate: Number
    });
     const form = useForm({
        start_date: null,
        end_date: null,
     });
     const numberOfDays = computed(() => {
  if (!form.start_date || !form.end_date) return 0;

  const start = new Date(form.start_date)
  const end = new Date(form.end_date);

  const diff = (end - start) / (1000 * 60 * 60 * 24); // ms to days

  return diff > 0 ? diff : 0;
});

// 💰 Compute the total amount
const amount = computed(() => {
  return numberOfDays.value * props.rate;
});
    
    const  makeBooking = () => form.post(route('rent.booking.store', {rent: props.rentId}), {
        preserveScroll: true,
        preserveState: true,
    });
    
   
    </script>