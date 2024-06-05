<template>
    <box>
      <div>
        <Link
          :href="route('listing.show', {listing: listing.id})"
        >
          <div class="flex items-center gap-1">
            <Price
              :price="listing.price"
              class="text-2xl font-bold"
            />
            <div class="text-xs text-gray-500">
              <Price :price="monthlyPayment" /> pm
            </div>
          </div>
          <ListingSpace :listing="listing" class="text-lg" />
          <ListingAddress
            :listing="listing"
            class="text-gray-500"
          />
        </Link>
      </div>
      <div>
        <Link
          :href="route('listing.edit', {listing: listing.id})"
        >
          Edit
        </Link>
      </div>
      <div>
        <Link
          :href="route('listing.destroy', {listing: listing.id})"
          method="DELETE" as="button"
        >
          Delete
        </Link>
      </div>
    </box>
  </template>
  
  <script setup>

  import ListingAddress from '@/Components/listingAddress.vue'
  import box from '@/Components/UI/box.vue'
  import ListingSpace from '@/Components/listingSpace.vue'
  import Price from '@/Components/price.vue'
  
import { Link } from '@inertiajs/vue3';
  
  const props = defineProps({listing: Object})
 
  </script>