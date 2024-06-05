<template>
  <filters/>
  <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
    <listing v-for="listing in listings.data" :key="listing.id" :listing="listing" />
  </div>

  <div v-if="listings.data.length" class="w-full flex justify-center mt-8 mb-8">
    <pagination :links="listings.links" />
  </div>
</template>

<script setup>
import listing from '@/Pages/Listing/Index/Components/listing.vue'
import pagination from '@/Components/UI/pagination.vue'
import filters from '@/Pages/Listing/Index/Components/filters.vue'
defineProps({
  listings: Object,
})
</script>
