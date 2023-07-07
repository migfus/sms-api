<template>
  <li>
    <div :to="`/users/${data.id}`" class="block hover:bg-gray-50">
      <div class="flex items-center px-4 py-4 sm:px-6">

        <div class="flex min-w-0 flex-1 items-center">

          <div class="flex-shrink-0">
            <img class="h-12 w-12 rounded-full" :src="data.avatar" alt="" />
          </div>

          <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">
            <div>
              <p class="truncate text-sm font-medium text-primary-600">{{ convertName(data.person) }}</p>
              <p class="mt-2 flex items-center text-sm text-gray-500">
                <EnvelopeIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                <span class="truncate">{{ data.email }}</span>
              </p>
            </div>

            <div class="block">
              <div>
                <p class="text-sm text-gray-900">
                  <time :datetime="data.created_at">{{ moment(data.created_at).format('MMM DD, YYYY') }}</time>
                </p>
                <p class="mt-2 flex items-center text-sm text-gray-500">
                  <CheckCircleIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-green-400" aria-hidden="true" />
                  {{ data.email }}
                </p>
              </div>
            </div>
          </div>

        </div>

        <div>
          <ChevronRightIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
        </div>

      </div>
    </div>
  </li>
</template>

<script setup lang="ts">
import { toRefs } from 'vue'
import moment from 'moment'
import {convertName} from '@/helpers/Converter'
import { CheckCircleIcon } from '@heroicons/vue/20/solid'


const $props = defineProps<{
  data?: {
    id: number,
    email: string,
    avatar: string,
    person: {
      last_name: string,
      first_name: string,
      mid_name: string,
      ext_name: string,
    },
    created_at: string
  }
}>()
const { data } = toRefs($props)
</script>
