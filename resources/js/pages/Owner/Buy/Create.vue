
<template>

    <div class="mb-8 mt-4 text-center font-medium text-slate-500 text-2xl"> Add Listing - For Sale</div>
    <form @submit.prevent="submit" class="mb-16">
      <div class="grid grid-cols-6 gap-4">
        <!-- Brand -->
        <div class="col-span-2">
          <label class="label">Brand</label>
          <div class="relative">
            <i class="fas fa-car absolute left-3 top-3 text-gray-400"></i>
            <input
              v-model="form.brand"
              type="text"
              required
              class="input pl-10"
             
            />
          </div>
          <div class="input-error" v-if="form.errors.brand">{{ form.errors.brand }}</div>
        </div>
  
        <!-- Model -->
        <div class="col-span-2">
          <label class="label">Model</label>
          <div class="relative">
            <i class="fas fa-cogs absolute left-3 top-3 text-gray-400"></i>
            <input
              v-model="form.model"
              type="text"
              required
              class="input pl-10"
             
            />
          </div>
          <div class="input-error" v-if="form.errors.model">{{ form.errors.model }}</div>
        </div>
  
        <!-- Year -->
        <div class="col-span-2">
          <label class="label">Year</label>
          <div class="relative">
            <i class="fas fa-calendar-alt absolute left-3 top-3 text-gray-400"></i>
            <input
              v-model.number="form.year"
              type="number"
              required
              class="input pl-10"
          
            />
          </div>
          <div class="input-error" v-if="form.errors.year">{{ form.errors.year }}</div>
        </div>
  
        <!-- Colour -->
        <div class="col-span-2">
          <label class="label">Colour</label>
          <div class="relative">
            <i class="fas fa-palette absolute left-3 top-3 text-gray-400"></i>
            <input
              v-model="form.colour"
              type="text"
              required
              class="input pl-10"
             
            />
          </div>
          <div class="input-error" v-if="form.errors.colour">{{ form.errors.colour }}</div>
        </div>
  
       
  
        <!-- Price -->
        <div class="col-span-4">
          <label class="label">Price</label>
          <div class="relative">
            <i class="fas fa-pound-sign absolute left-3 top-3 text-gray-400"></i>
            <input
              v-model="form.price"
              type="number"
              required
              class="input pl-10"
             
            />
          </div>
          <div class="input-error" v-if="form.errors.price">{{ form.errors.price }}</div>
        </div>
  
      <!-- Category -->
<div class="col-span-3">
  <label class="label">Category</label>
  <div class="relative">
    <i class="fas fa-th-list absolute left-3 top-3 text-gray-400"></i>
    <select
      v-model="form.category"
      required
      class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md text-gray-700 focus:outline-none focus:ring-0 ring-1"
    >
      <option disabled value="">Select Category</option>
      <option value="EV">EV</option>
      <option value="Fuel">Fuel</option>
      <option value="Hybrid">Hybrid</option>
    </select>
  </div>
  <div class="input-error" v-if="form.errors.category">{{ form.errors.category }}</div>
</div>

<!-- Type -->
<div class="col-span-3">
  <label class="label">Type</label>
  <div class="relative">
    <i class="fas fa-tags absolute left-3 top-3 text-gray-400"></i>
    <select
      v-model="form.type"
      required
      class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md text-gray-700 focus:outline-none focus:ring-0 ring-1 "
    >
      <option disabled value="">Select Type</option>
      <option value="SUV">SUV</option>
      <option value="Saloon">Saloon</option>
      <option value="Bus">Bus</option>
      <option value="Van">Van</option>
    </select>
  </div>
  <div class="input-error" v-if="form.errors.type">{{ form.errors.type }}</div>
</div>

        <!-- Submit Button -->
        <div class="col-span-6">
          <button class="btn-primary" type="submit">Add</button>
        </div>
      </div>
    </form>
  </template>
  
    
      
      
        
    
    <script setup lang="ts">
    import {useForm} from  '@inertiajs/vue3'

    
    const form = useForm({
      year: null,
      price: null,
      colour: null,
      model: null,
      brand: null,
      type: null,
      category: null,
    
      })
    
      const submit = () => {
        form.post(
          route('owner-buy.store'),
          {
            preserveState: true,
            preserveScroll: true,
          },
        )
      }
    
    </script>
    <script lang="ts">
    import MainLayout from '@/layouts/MainLayout.vue';
    export default {
      layout: MainLayout,
      
    }
    </script>
