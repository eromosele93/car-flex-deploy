<template>

    <div class="text-2xl font-bold text-slate-700 text-center">Upload Images</div>
    <Box>
        
        <form @submit.prevent="upload">
    <section class="flex items-center gap-2 my-4">
        <input 
        class="border rounded-md file:px-4 file:py-2 border-gray-200 dark:border-gray-700
         file:text-gray-700 file:dark:text-gray-400 file:border-0 file:bg-gray-100 file:dark:bg-gray-800
         file:font-medium file:hover:bg-gray-200 file:dark:hover:bg-gray-700 file:hover:cursor-pointer file:mr-4"
        type="file" multiple @input="addFiles">
    <button type="submit" class="btn-outline disabled:opacity-25 disabled:cursor-not-allowed" :disabled="!canUpload">Upload</button>
    <button type="reset" class="btn-outline" @click="reset">Reset</button>
    
    </section>
    <div v-if="imageErrors.length" class="input-error">
            <div v-for="(error, index) in imageErrors" :key="index">
              {{ error }}
            </div>
          </div>
        </form>
        </Box>
        <Box v-if="rent.rent_images.length" class="mt-8">
        
    
        <section class="mt-4 grid grid-cols-4 gap-4">
    <div v-for="image in rent.rent_images" :key="image.id">
        <img :src="image.src" class="rounded-md"/>
        <Link :href="route('rent.images.destroy', {rent: rent.id, image: image.id})"
    method="delete" as="button" class="mt-2 btn-outline text-xs w-full">
    Delete
    </Link>
    </div>
    
        </section>
      </Box>
        </template>
    
    
    <script setup lang="ts">
    import {computed} from 'vue'
    import {Link} from '@inertiajs/vue3'
    import Box from '@/components/ui/Box.vue'
    import { useForm } from '@inertiajs/vue3'
    import 'nprogress/nprogress.css'
    
    const props = defineProps({ rent: Object })
    
    
    const form = useForm({
      images: [],
    })
    
    const canUpload = computed(() => form.images.length)
    const upload = () => {
      form.post(
        route('rent.images.store', { rent: props.rent.id }),
        {
          onSuccess: () => form.reset('images')
        },
      )
    }
    const addFiles = (event) => {
      for (const image of event.target.files) {
        form.images.push(image)
      }
    }
    const reset = () => form.reset('images')
    const imageErrors = computed(() => Object.values(form.errors))
    </script>
    
    <script lang="ts">
        import MainLayout from '@/layouts/MainLayout.vue';
        export default {
          layout: MainLayout,
          
        }
        </script>
    