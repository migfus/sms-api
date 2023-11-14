<template>
  <div>
    <div v-if="locations.size > 0" class="max-w-lg mt-4">
      <label for="search" class="block text-primary-600 font-medium text-sm">Work Location</label>
      <div class="mt-2 space-y-3">
        <div v-for="row in locations" class="flex items-center">
          <input v-model="$job.query.selectedLocation" :value="row" :id="`_${row}`" :name="`_${row}`" type="checkbox" class="h-4 w-4 rounded border-gray-200 text-amber-400 focus:ring-amber-400" />
          <label :for="`_${row}`" class="ml-2 block text-sm font-medium text-gray-700">{{ row }}</label>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { computed } from 'vue'
import { useJobPublicStore } from '@/store/@public/JobPublicStore'

const $job = useJobPublicStore();

const locations = computed(() => new Set($job.content.map(row => row.job_location.name)));
</script>
