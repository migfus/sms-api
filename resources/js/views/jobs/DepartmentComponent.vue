<template>
  <div>
    <div class="max-w-lg mt-4">
      <label for="search" class="block text-primary-600 font-medium text-sm">Departments/Offices</label>
      <div class="mt-2 space-y-3">
        <div v-for="row in departments" class="flex items-center">
          <input v-model="$job.params.selectedDepartments" :value="row" :id="`_${row}`" :name="`_${row}`" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-primary-600 focus:ring-primary-500" />
          <label :for="`_${row}`" class="ml-2 block text-sm font-medium text-gray-700">{{ row }}</label>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'
import { useJobPublicStore } from '@/store/job/JobPublicStore';

const $job = useJobPublicStore();

const departments = computed(() => new Set($job.content.map(row => row.job_department.name)));
</script>
