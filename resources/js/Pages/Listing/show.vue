<template>
  <div>
    <h1 class="text-xl font-bold mb-4">Szczegóły produktu</h1>

    <div class="overflow-x-auto mb-4">
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
          </tr>
        </thead>
        <tbody>
          <tr class="hover:bg-gray-100">
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
            <td class="w-1/8 px-2 py-1 border-b border-l text-sm text-center">{{ product.purchase_units_number }} {{ product.purchase_units_type }}</td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="mb-4">
      <label for="quantity" class="block text-sm font-medium text-gray-700">Wprowadź ilość produktu:</label>
      <input type="number" id="quantity" v-model="quantity" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>
    <button @click="calculateUnits" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700">Oblicz jednostki zakupu</button>

    <div v-if="result" class="mt-4">
      <p>Liczba palet: {{ result.pallets }}</p>
      <p>Liczba jednostek: {{ result.units.toFixed(2) }}</p>
      <p>Maksymalna ilość na paletę: {{ result.maxUnitsPerPallet }} jednostek zakupu</p>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const props = defineProps({
  product: Object,
});

const quantity = ref(1);
const result = ref(null);

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


const getPackagingUnits = (product) => {
  const packagingType = determinePackagingType(product);

  switch (packagingType) {
    case 'rolka':
      return 1; 
    case 'm2':
      return (product.length * product.width) / 1_000_000; 
    case 'karton':
    case 'paczka':
      return 1; 
    case 'paleta':
      return 1; 
    case 'm':
      return product.length / 1000; 
    case 'm3':
      return (product.length * product.width * product.thickness) / 1_000_000; 
    case 'szt':
    case 'bst':
    case 'krt':
    default:
      return 1;
  }
};

const calculateUnits = () => {
  const packagingType = determinePackagingType(props.product);
  const unitsPerPallet = unitsPerPalletValue[packagingType] || 1;
  const productUnits = getPackagingUnits(props.product);
  const totalUnits = quantity.value * productUnits;
  const palletsNeeded = Math.ceil(totalUnits / unitsPerPallet);

  result.value = {
    pallets: palletsNeeded,
    units: totalUnits,
    percentFilled: (totalUnits / (palletsNeeded * unitsPerPallet)) * 100,
    maxUnitsPerPallet: unitsPerPallet 
  };
};
</script>

<style scoped>
input[type="number"] {
  width: 100px;
}
</style>
