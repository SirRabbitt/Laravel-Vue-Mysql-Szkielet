<template>
  <filters :filters="filters" />
  <div class="overflow-x-auto">
    <table class="min-w-full bg-white border border-gray-200">
      <thead>
        <tr>
          <th class="w-2/5 px-2 py-1 border-b text-sm">Nazwa produktu</th>
          <th class="w-1/5 px-2 py-1 border-b text-sm ">Producent</th>
          <th class="w-1/8 px-2 py-1 border-b text-sm">Ilosc</th>
          <th class="w-1/8 px-2 py-1 border-b text-sm">Typ pakowania</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="listing in listings.data" :key="listing.id" class="hover:bg-gray-100">
          <td class="w-1/5 px-2 py-1 border-b text-sm">
            <Link :href="route('listing.show', {listing: listing.id})">
              {{ listing.name }}
            </Link>
          </td>
          <td class="w-2/5 px-2 py-1 border-b text-sm text-center">{{ listing.manufacturer }}</td>
          <td class="w-1/8 px-2 py-1 border-b text-sm text-center" >{{ listing.total_units }}</td>
          <td class="w-1/8 px-2 py-1 border-b text-sm text-center">{{ listing.purchase_units_type }}</td>
        </tr>
      </tbody>
    </table>
  </div>
  
  <div v-if="listings.data.length" class="w-full flex justify-center mt-4 mb-4">
    <pagination :links="listings.links" />
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

import pagination from '@/Pages/Listing/Index/Components/pagination.vue'

import filters from '@/Pages/Listing/Index/Components/filters.vue'

const props = defineProps({
  listings: Object,
  filters: Object,
})
</script>
