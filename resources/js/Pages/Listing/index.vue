<template>
  <filters :filters="filters" />
  <div class="overflow-x-auto">
    <table class="min-w-full bg-white border border-gray-200">
      <thead>
        <tr>
          <th class="w-2/5 px-2 py-1 border-b border-l text-sm text-center">Nazwa produktu</th>
          <th class="w-1/5 px-2 py-1 border-b border-l text-sm text-center">Producent</th>
          <th class="w-1/8 px-2 py-1 border-b border-l text-sm text-center">Jednostka ceny</th>
          <th class="w-1/8 px-2 py-1 border-b border-l text-sm text-center">Waga</th>
          <th class="w-1/8 px-2 py-1 border-b border-l text-sm text-center">Średnica</th>
          <th class="w-1/8 px-2 py-1 border-b border-l text-sm text-center">Długość</th>
          <th class="w-1/8 px-2 py-1 border-b border-l text-sm text-center">Szerokość</th>
          <th class="w-1/8 px-2 py-1 border-b border-l text-sm text-center">Wysokość</th>
          <th class="w-1/8 px-2 py-1 border-b border-l text-sm text-center">Grubość</th>
          <th class="w-1/8 px-2 py-1 border-b border-l text-sm text-center">Typ pakowania</th>
          <th class="w-1/8 px-2 py-1 border-b border-l text-sm text-center">Jednostka zakupu</th>
          <th class="w-1/8 px-2 py-1 border-b border-l text-sm text-center">Maksymalna ilość Jednostek zakupu na paletę</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="listing in listings.data" :key="listing.id" class="hover:bg-gray-100">
          <td class="w-2/5 px-2 py-1 border-b border-l text-sm text-center">
            <Link :href="route('listing.show', {listing: listing.id})">
              {{ listing.name }}
            </Link>
          </td>
          <td class="w-1/5 px-2 py-1 border-b border-l text-sm text-center">{{ listing.manufacturer }}</td>
          <td class="w-1/8 px-2 py-1 border-b border-l text-sm text-center">{{ listing.unit_price }}</td>
          <td class="w-1/8 px-2 py-1 border-b border-l text-sm text-center">{{ listing.weight }}</td>
          <td class="w-1/8 px-2 py-1 border-b border-l text-sm text-center">{{ listing.diameter }}</td>
          <td class="w-1/8 px-2 py-1 border-b border-l text-sm text-center">{{ listing.length }}</td>
          <td class="w-1/8 px-2 py-1 border-b border-l text-sm text-center">{{ listing.width }}</td>
          <td class="w-1/8 px-2 py-1 border-b border-l text-sm text-center">{{ listing.height }}</td>
          <td class="w-1/8 px-2 py-1 border-b border-l text-sm text-center">{{ listing.thickness }}</td>
          <td class="w-1/8 px-2 py-1 border-b border-l text-sm text-center">{{ listing.packaging_type }}</td>
          <td class="w-1/8 px-2 py-1 border-b border-l text-sm text-center">{{ listing.purchase_units_number }} {{ listing.purchase_units_type }}</td>
          <td class="w-1/8 px-2 py-1 border-b border-l text-sm text-center">{{ calculateMaxUnitsPerPallet(listing) }}</td>
        </tr>
      </tbody>
    </table>
  </div>
  
  <div v-if="listings.data.length" class="w-full flex justify-center mt-4 mb-4">
    <pagination :links="listings.links" />
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import pagination from '@/Pages/Listing/Index/Components/pagination.vue';
import filters from '@/Pages/Listing/Index/Components/filters.vue';

const props = defineProps({
  listings: Object,
  filters: Object,
});

const unitsPerPalletValue = {
  rolka: 80,
  karton: 7,
  paczka: 2, 
  paleta: 1,
  m: 200,
  m2: 150,
  szt: 400,
  m3: 1, 
  bst: 400,
  krt: 400, 
};


const determinePackagingType = (product) => {
  const packagingType = product.packaging_type ? product.packaging_type.toLowerCase() : product.unit_price ? product.unit_price.toLowerCase() : 'szt';
  return packagingType;
};


const calculateMaxUnitsPerPallet = (product) => {
  const packagingType = determinePackagingType(product);
  return unitsPerPalletValue[packagingType] || unitsPerPalletValue['szt'];
};
</script>
