<template>
  <form @submit.prevent="filter">
    <div class="mb-8 mt-4 flex flex-wrap gap-2">
      <div class="flex flex-nowrap items-center">
        <input
          v-model.number="filterForm.priceFrom"
          type="text" placeholder="Price from"
          class="input-filter-l w-28"
        />
        <input
          v-model.number="filterForm.priceTo"
          type="text" placeholder="Price to" 
          class="input-filter-r w-28"
        />
      </div>

      <div class="flex flex-nowrap items-center">
        <select v-model="filterForm.beds" class="input-filter-l w-28">
          <option :value="null">Beds</option>
          <option v-for="n in 5" :key="n" :value="n">{{ n }}</option>
          <option>6+</option>
        </select>
        <select v-model="filterForm.baths" class="input-filter-r w-28">
          <option :value="null">Baths</option>
          <option v-for="n in 5" :key="n" :value="n">{{ n }}</option>
          <option>6+</option>
        </select>
      </div>

      <div class="flex flex-nowrap items-center">
        <input
          v-model.number="filterForm.areaFrom"
          type="text" placeholder="Area from"
          class="input-filter-l w-28"
        />
        <input
          v-model.number="filterForm.areaTo"
          type="text" placeholder="Area to"
          class="input-filter-r w-28"
        />
      </div>

      <button type="submit" class="btn-normal">Filter</button>
      <button type="reset" @click="clear">Clear</button>
    </div>
  </form>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';

// Pobieranie parametrów URL z globalnej funkcji `route().params`
const filtersFromRoute = {
  priceFrom: route().params.priceFrom ?? null,
  priceTo: route().params.priceTo ?? null,
  beds: route().params.beds ?? null,
  baths: route().params.baths ?? null,
  areaFrom: route().params.areaFrom ?? null,
  areaTo: route().params.areaTo ?? null,
};

const filterForm = useForm({
  priceFrom: filtersFromRoute.priceFrom,
  priceTo: filtersFromRoute.priceTo,
  beds: filtersFromRoute.beds,
  baths: filtersFromRoute.baths,
  areaFrom: filtersFromRoute.areaFrom,
  areaTo: filtersFromRoute.areaTo,
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
  filterForm.priceFrom = null
  filterForm.priceTo = null
  filterForm.beds = null
  filterForm.baths = null
  filterForm.areaFrom = null
  filterForm.areaTo = null
  filter()
}
</script>
