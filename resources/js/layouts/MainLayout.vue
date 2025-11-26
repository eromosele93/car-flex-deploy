

<template>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

        </head>
    <header class="border-b border-purple-400 dark:border-purple-700 bg-white dark:bg-gray-900 w-full">
      <div class="container mx-auto px-4">
        <nav class="py-4 flex items-center justify-between flex-wrap">
          <!-- Logo -->
          <div class="text-2xl text-purple-800 font-medium"><Link :href="route('home')"> Car-Flex </Link></div>
  
          <!-- Hamburger Menu (mobile only) -->
          <button @click="isOpen = !isOpen" class="md:hidden text-purple-800 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
              viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
  
          <!-- Navigation Links -->
          <div :class="['w-full md:flex md:items-center md:w-auto', isOpen ? 'block' : 'hidden']">
            <div v-if="user" class="flex flex-col md:flex-row md:gap-6 gap-2 mt-4 md:mt-0 text-purple-800 text-lg items-center">
  <!-- Notification -->
  <Link :href="route('notifications.index')" class="relative flex items-center pr-2 py-2 text-slate-500">
    🔔
    <div v-if="notificationCount"
      class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center border border-white"
    >
      {{ notificationCount }}
    </div>
  </Link>

  <!-- User Dropdown -->
  <div class="relative group">
    <div class="hover:text-purple-600 flex items-center gap-2 cursor-pointer">
      <i class="fas fa-user text-purple-500"></i>
      {{ user.name }}
      <i class="fas fa-chevron-down text-purple-400 text-sm mt-[1px]"></i>
    </div>
    <div
      class="absolute left-0 mt-0 w-48 bg-white dark:bg-gray-800 shadow-md rounded z-50
             opacity-0 group-hover:opacity-100 group-hover:translate-y-0
             transition-all duration-200 ease-in-out transform translate-y-2
             pointer-events-none group-hover:pointer-events-auto"
    >
      <Link
        :href="route('owner-rent.index')"
        class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-purple-100 dark:hover:bg-gray-700"
      >
        <i class="fas fa-car text-purple-500 mr-2"></i>Your Rent Listing
      </Link>
      <Link
        :href="route('owner-buy.index')"
        class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-purple-100 dark:hover:bg-gray-700"
      >
        <i class="fas fa-car-side text-purple-500 mr-2"></i>Your Sales Listing
      </Link>
    </div>
  </div>

  <!-- Activities Dropdown -->
  <div class="relative group">
    <div class="hover:text-purple-600 flex items-center gap-2 cursor-pointer">
      <i class="fas fa-list text-purple-500"></i>
      Activities
      <i class="fas fa-chevron-down text-purple-400 text-sm mt-[1px]"></i>
    </div>
    <div
      class="absolute left-0 mt-0 w-48 bg-white dark:bg-gray-800 shadow-md rounded z-50
             opacity-0 group-hover:opacity-100 group-hover:translate-y-0
             transition-all duration-200 ease-in-out transform translate-y-2
             pointer-events-none group-hover:pointer-events-auto"
    >
      <Link
        :href="route('bookings-made.index')"
        class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-purple-100 dark:hover:bg-gray-700"
      >
        <i class="fas fa-calendar-check text-purple-500 mr-2"></i>Bookings Made
      </Link>
      <Link
        :href="route('offers-made.index')"
        class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-purple-100 dark:hover:bg-gray-700"
      >
        <i class="fas fa-handshake text-purple-500 mr-2"></i>Offers Made
      </Link>
    </div>
  </div>

  <!-- New Listing Dropdown -->
  <div class="relative group">
    <div class="hover:text-purple-600 flex items-center gap-2 cursor-pointer">
      <i class="fas fa-plus-circle text-purple-500"></i>
      New Listing
      <i class="fas fa-chevron-down text-purple-400 text-sm mt-[1px]"></i>
    </div>
    <div
      class="absolute left-0 mt-0 w-48 bg-white dark:bg-gray-800 shadow-md rounded z-50
             opacity-0 group-hover:opacity-100 group-hover:translate-y-0
             transition-all duration-200 ease-in-out transform translate-y-2
             pointer-events-none group-hover:pointer-events-auto"
    >
      <Link
        :href="route('owner-rent.create')"
        class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-purple-100 dark:hover:bg-gray-700"
      >
        <i class="fas fa-car text-purple-500 mr-2"></i>Rent
      </Link>
      <Link
        :href="route('owner-buy.create')"
        class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-purple-100 dark:hover:bg-gray-700"
      >
        <i class="fas fa-car-side text-purple-500 mr-2"></i>Buy
      </Link>
    </div>
  </div>

  <!-- Logout -->
  <Link :href="route('logout')" method="delete" as="button" class="hover:text-purple-600 flex items-center gap-2">
    <i class="fas fa-sign-out-alt text-purple-500"></i>
    Logout
  </Link>
</div>

            <div v-else class="flex flex-col md:flex-row md:gap-6 gap-2 mt-4 md:mt-0 text-purple-800 text-lg">
              
              <!-- Login -->
<Link :href="route('login')" class="hover:text-purple-600 flex items-center gap-2">
  <i class="fas fa-sign-in-alt text-purple-500"></i>
  Login
</Link>

<!-- Register -->
<Link :href="route('user-account.create')" class="hover:text-purple-600 flex items-center gap-2">
  <i class="fas fa-user-plus text-purple-500"></i>
  Register
</Link>

            </div>
          </div>
        </nav>
      </div>
    </header>
  
    <main class="container mx-auto px-4 py-6 w-full">
      <div v-if="flashSuccess" class="mb-4 border rounded-md shadow-sm border-green-200 dark:border-green-800 bg-green-50 dark:bg-green-900 p-2">
{{ flashSuccess }}
</div>
<div v-else-if="flashError" class="mb-4 border rounded-md shadow-sm border-red-200 dark:border-red-800 bg-red-50 dark:bg-red-900 p-2">
{{ flashError }}
</div>
      <slot></slot>
    </main>
  </template>


<script setup lang="ts">
 import {computed} from 'vue'
import { ref } from 'vue'
import { Link, usePage } from '@inertiajs/vue3'
const isOpen = ref(false)
const page = usePage()
const user = computed(

()=>page.props.user
)
const flashSuccess = computed(

()=>page.props.flash.success
)
const flashError = computed(

()=>page.props.flash.error
)

const notificationCount = computed(
()=>Math.min(page.props.user.notificationCount, 9),
)
</script>