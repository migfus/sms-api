<template>
  <div class="overflow-hidden bg-white shadow sm:rounded-md">
    <ul role="list" class="divide-y divide-gray-200">

      <li v-if="$job.content.length == 0">
        <div class="block hover:bg-gray-50">
          <div class="px-4 py-4 sm:px-6">
            <div v-if="$job.params.search == '' && $job.config.loading == false" class="flex items-center justify-center">
              <p class="truncate text-sm font-medium text-primary-600 item-center">
                Sorry it seems empty today.
              </p>
              <FaceFrownIcon class="mr-1.5 h-10 w-10 ml-2 flex-shrink-0 text-gray-400" aria-hidden="true" />
            </div>
            <div v-else class="flex items-center justify-between">
              <p class="truncate text-sm font-medium text-primary-600 item-center">
                No search result found.
              </p>
              <MagnifyingGlassIcon class="mr-1.5 h-7 w-7 ml-2 flex-shrink-0 text-gray-400" aria-hidden="true" />
            </div>
          </div>
        </div>
      </li>

      <li v-for="position in $job.filterJobs" :key="position.id">
        <RouterLink :to="`job/${position.id}`" class="block hover:bg-gray-50">
          <div class="px-4 py-4 sm:px-6">
            <div class="flex items-center justify-between">
              <p class="truncate text-sm font-medium text-primary-600">{{ position.title }}</p>
              <div class="ml-2 flex flex-shrink-0">
                <p class="inline-flex rounded-full bg-amber-100 px-2 text-xs font-semibold leading-5 text-amber-800 mr-2">{{ position.job_status.name }}</p>
                <p class="inline-flex rounded-full bg-primary-100 px-2 text-xs font-semibold leading-5 text-primary-800">{{ position.job_type.name }}</p>
              </div>
            </div>
            <div class="mt-2 sm:flex sm:justify-between">
              <div class="sm:flex">
                <p class="flex items-center text-sm text-gray-500">
                  <UsersIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                  {{ position.job_department.name }}
                </p>
                <p class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0 sm:ml-6">
                  <MapPinIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                  {{ position.job_location.name }}
                </p>
              </div>
              <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                <CalendarIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                <p>
                  Closing on
                  <time :datetime="position.closeDate">{{ moment(position.unposted_at).format('MMM DD, YYYY') }}</time>
                </p>
              </div>
            </div>


            <div class="mt-2 grid grid-cols-2 bg-gray-100 text-gray-600 rounded-lg px-2 py-2">
              <div class="text-sm">
                <b>Description:</b>
                <p>{{ position.description }}</p>
              </div>
            </div>
          </div>
        </RouterLink>
      </li>
    </ul>
  </div>
</template>

<script setup>
import { CalendarIcon, MapPinIcon, UsersIcon, FaceFrownIcon, MagnifyingGlassIcon } from '@heroicons/vue/20/solid'
import { useJobPublicStore } from '@/store/job/JobPublicStore';
import moment from 'moment'

const $job = useJobPublicStore();
</script>
