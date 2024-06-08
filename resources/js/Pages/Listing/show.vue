<template>
  <div>
    <h1 class="text-xl font-bold mb-4">Szczegóły produktu</h1>
 

   
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
          </tr>
        </thead>
        <tbody>
          <tr v-for="product in products" :key="product.id" class="hover:bg-gray-100">
            <td class="w-2/5 px-2 py-1 border-b border-l text-sm text-center">{{ product.name }}</td>
            <td class="w-1/5 px-2 py-1 border-b border-l text-sm text-center">{{ product.manufacturer }}</td>
            <td class="w-1/8 px-2 py-1 border-b border-l text-sm text-center">{{ product.unit_price }}</td>
            <td class="w-1/8 px-2 py-1 border-b border-l text-sm text-center">{{ product.weight }}</td>
            <td class="w-1/8 px-2 py-1 border-b border-l text-sm text-center">{{ product.diameter }}</td>
            <td class="w-1/8 px-2 py-1 border-b border-l text-sm text-center">{{ product.length }}</td>
            <td class="w-1/8 px-2 py-1 border-b border-l text-sm text-center">{{ product.width }}</td>
            <td class="w-1/8 px-2 py-1 border-b border-l text-sm text-center">{{ product.height }}</td>
            <td class="w-1/8 px-2 py-1 border-b border-l text-sm text-center">{{ product.thickness }}</td>
            <td class="w-1/8 px-2 py-1 border-b border-l text-sm text-center">{{ product.packaging_type }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
  products: Array,
  purchaseUnit: Object,
});
</script>
