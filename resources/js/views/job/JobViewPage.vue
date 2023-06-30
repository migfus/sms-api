<template>
  <div class="min-h-full">
    <main class="mt-4 pb-8">
      <div class="mx-auto max-w-3xl lg:max-w-7xl px-4 sm:px-6">
        <h1 class="sr-only">Page title</h1>

        <div class="grid grid-cols-1 gap-4 mb-4">
          <div class="grid grid-cols-1 gap-4 col-span-3 ">
            <section aria-labelledby="section-1-title">
              <h2 class="sr-only" id="section-1-title">Section title</h2>
              <div class="flex justify-between overflow-hidden rounded-lg bg-white shadow">
                <div class="p-7 font-semibold">
                  {{ data.title }}
                </div>
                <div class="px-6 py-4 text-end">
                  <span class="isolate inline-flex rounded-md shadow-sm mt-1">
                    <RouterLink :to="{name: 'job-listing'}" @click="$job.Reset()" type="button" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 focus:z-10 focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500">
                      <ArrowLeftCircleIcon class="-ml-1 mr-2 h-5 w-5 text-gray-400" aria-hidden="true" />
                      Back to list
                    </RouterLink>
                  </span>
                </div>
              </div>
            </section>
          </div>
        </div>

        <div class="grid grid-cols-1 items-start gap-4">
          <div class="grid grid-cols-1 lg:col-span-2 gap-4">
            <section aria-labelledby="section-2-title">
              <h2 class="sr-only" id="section-2-title">Section title</h2>
              <div class="overflow-hidden rounded-lg bg-white shadow">
                <JobContent :data="data"/>
              </div>
            </section>
          </div>
        </div>

        <JobApply />

      </div>
    </main>
  </div>
</template>

<script setup lang="ts">
import { useJobPublicStore } from '@/store/job/JobPublicStore';
import { useRoute } from 'vue-router';
import { reactive } from 'vue';
import { ArrowLeftCircleIcon } from '@heroicons/vue/20/solid';
import { useTitle } from '@vueuse/core'
import JobApply from './JobApply.vue'

import JobContent from './JobContent.vue';

const $job = useJobPublicStore();
const $route = useRoute();

const data = reactive({
  ...$job.content.filter((row) => row.id == Number($route.params.id))[0]
});

useTitle(`${data.title} | CMU HRMO`);
</script>
