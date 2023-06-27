<template>
  <div>
    <label for="search" class="block text-sm font-medium text-primary-600">Search</label>
    <div class="mt-1">
      <input v-model="$job.params.search" type="text" id="search" placeholder="Lookup for listing" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm"/>
    </div>
  </div>
</template>

<script setup>
import { useJobPublicStore } from '@/store/job/JobPublicStore';

const $job = useJobPublicStore();
</script>
