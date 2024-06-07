<template>
  <form @submit.prevent="filter">
    <div class="mb-8 mt-4 flex flex-wrap gap-2">
      <div class="flex flex-nowrap items-center">
        <input
          v-model="filterForm.name"
          type="text" placeholder="Product name"
          class="input-filter-l w-56"
        />
      </div>
      <div class="flex flex-nowrap items-center">
        <input
          v-model="filterForm.manufacturer"
          type="text" placeholder="Manufacturer"
          class="input-filter-l w-56"
        />
      </div>
      <div class="flex flex-nowrap items-center">
        <label for="perPage" class="mr-2">wielkosc tabeli :</label>
        <select v-model="filterForm.perPage" id="perPage" class="input-filter-l w-28">
          <option value="10">10</option>
          <option value="20">20</option>
          <option value="50">50</option>
          <option value="100">100</option>
        </select>
      </div>
      <div class="flex flex-nowrap items-center">
        <button type="submit" class="btn-normal mr-2">Filter</button>
        <button type="reset" @click="clear" class="btn-normal">Clear</button>
      </div>
    </div>
  </form>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';

// Pobieranie parametrów URL z globalnej funkcji `route().params`
const filtersFromRoute = {
  name: route().params.name ?? '',
  manufacturer: route().params.manufacturer ?? '',
  perPage: route().params.perPage ?? 20,
};

const filterForm = useForm({
  name: filtersFromRoute.name,
  manufacturer: filtersFromRoute.manufacturer,
  perPage: filtersFromRoute.perPage,
});

const filter = () => {
  filterForm.get(
    route('listing.index'),
    {
      preserveState: true,
      preserveScroll: true,
    },
  )
}

const clear = () => {
  filterForm.name = ''
  filterForm.manufacturer = ''
  filterForm.perPage = 20
  filter()
}
</script>
