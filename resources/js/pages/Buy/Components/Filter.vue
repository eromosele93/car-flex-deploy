
   <template>

<div class="sm:hidden mb-4">
    <button
      @click="showFilters = !showFilters"
      class="flex items-center gap-2 px-4 py-2 bg-purple-600 text-white rounded w-full justify-center"
    >
      <i class="fas fa-filter"></i>
      <span>Filter</span>
    </button>
  </div>
  <form @submit.prevent="filter" class="mb-16" :class="{ hidden: !showFilters && isSmallScreen }">
    <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6">
  
        <div class="relative">
          <input
            type="text"
            placeholder="Brand"
            v-model="filterForm.brand"
            class="input-filter w-full pl-10"
          />
          <i class="fas fa-car absolute top-3 left-3 text-gray-400"></i>
        </div>
  
        <div class="relative">
          <input
            type="text"
            placeholder="Model"
            v-model="filterForm.model"
            class="input-filter w-full pl-10"
          />
          <i class="fas fa-cogs absolute top-3 left-3 text-gray-400"></i>
        </div>
  
        <div class="relative">
          <input
            type="text"
            placeholder="Year"
            v-model.number="filterForm.year"
            class="input-filter w-full pl-10"
          />
          <i class="fas fa-calendar-alt absolute top-3 left-3 text-gray-400"></i>
        </div>
  
        <div class="relative">
          <input
            type="text"
            placeholder="Price From"
            v-model.number="filterForm.priceFrom"
            class="input-filter w-full pl-10"
          />
          <i class="fas fa-pound-sign absolute top-3 left-3 text-gray-400"></i>
        </div>
  
        <div class="relative">
          <input
            type="text"
            placeholder="Price To"
            v-model.number="filterForm.priceTo"
            class="input-filter w-full pl-10"
          />
          <i class="fas fa-pound-sign absolute top-3 left-3 text-gray-400"></i>
        </div>
  
        
        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-2">

  <select
    id="category"
    class="w-full sm:w-36 md:w-48 px-3 py-2 border border-purple-500 text-gray-400 font-medium rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
    v-model="filterForm.category"
  >
    <option :value="null">Select Category</option>
    <option value="EV">EV</option>
    <option value="Fuel">Fuel</option>
    <option value="Hybrid">Hybrid</option>
  </select>

</div>

  
      </div>
  
      <div class="flex flex-col sm:flex-row gap-2 w-full">
      <button
        type="submit"
        class="w-full sm:w-1/2 bg-purple-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition"
      >
        Filter
      </button>
      <button
        type="reset"
        @click="clear"
        class="w-full sm:w-1/2 bg-gray-200 text-gray-800 py-2 px-4 rounded hover:bg-gray-300 transition"
      >
        Clear
      </button>
    </div>

    </form>
  </template> 

  
  
    

<script setup lang="ts">
import {useForm} from  '@inertiajs/vue3'
import { ref, onMounted } from 'vue'
const showFilters = ref(false)
const isSmallScreen = ref(false)

onMounted(() => {
  // Check screen size once on load
  isSmallScreen.value = window.innerWidth < 640

  // Optional: Update if window resizes
  window.addEventListener('resize', () => {
    isSmallScreen.value = window.innerWidth < 640
  })
})

const props = defineProps({
    filters: Object,
  })
const filterForm = useForm({
  year: props.filters.year ?? null,
  priceFrom: props.filters.priceFrom ?? null,
  priceTo: props.filters.priceTo ?? null,
  model: props.filters.model ?? null,
  brand: props.filters.brand ?? '',
  type: props.filters.type ?? null,
  category: props.filters.category ?? null,

  })

  const filter = () => {
    filterForm.get(
      route('cars.index'),
      {
        preserveState: true,
        preserveScroll: true,
      },
    )
  }
  const clear = () => {
    filterForm.priceFrom = null
    filterForm.priceTo = null
    filterForm.model = null
    filterForm.brand = null
    filterForm.category = null
    filterForm.year = null
 
    filter()
  }
</script>