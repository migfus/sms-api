<template>
  <div>
    <div class="overflow-hidden bg-white shadow sm:rounded-md">
      <ul role="list" class="divide-y divide-gray-200">

        <li>
          <div class="block ">
            <div class="px-4 py-4 sm:px-6">
              <div class="flex items-center justify-between">
                <p class="truncate font-medium text-primary-600">{{ data.title }}</p>
                <div class="ml-2 flex flex-shrink-0">
                  <p class="inline-flex rounded-full bg-amber-100 px-2 text-sm font-semibold leading-5 text-amber-800 mr-2">{{ data.job_status.name }}</p>
                  <p class="inline-flex rounded-full bg-primary-100 px-2 text-sm font-semibold leading-5 text-primary-800">{{ data.job_type.name }}</p>
                </div>
              </div>
              <div class="mt-2 sm:flex sm:justify-between">
                <div class="sm:flex">
                  <p class="flex items-center text-gray-500">
                    <UsersIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                    {{ data.job_department.name }}
                  </p>
                  <p class="mt-2 flex items-center text-gray-500 sm:mt-0 sm:ml-6">
                    <MapPinIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                    {{ data.job_location.name }}
                  </p>
                </div>
                <div class="mt-2 flex items-center text-gray-500 sm:mt-0">
                  <CalendarIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                  <p>
                    Closing on
                    <time :datetime="data.unposted_at">{{ moment(data.unposted_at).format('MMM DD, YYYY') }}</time>
                  </p>
                </div>
              </div>


              <div class="mt-2 grid grid-cols-1 bg-gray-100 text-gray-600 rounded-lg px-2 py-2">
                <div class="col-span-2 lg:col-span-1">
                  <b>Description:</b>
                  <p>{{ data.description }}</p>
                </div>
                <div class="mt-2">
                  <b>Requirements:</b>
                  <p>{{ data.requirements }}</p>
                </div>
                <div class="mt-2">
                  <b>Qualifications:</b>
                  <p>{{ data.qualifications }}</p>
                </div>
                <div class="mt-2">
                  <b>Responsibilities:</b>
                  <p>{{ data.requirements }}</p>
                </div>
              </div>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>
</template>

<script setup lant="ts">
import moment from 'moment';
import { CalendarIcon, MapPinIcon, UsersIcon } from '@heroicons/vue/20/solid';

const $props = defineProps({
  data: Object
});
</script>
