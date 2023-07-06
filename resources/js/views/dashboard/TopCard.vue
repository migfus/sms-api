<template>
  <div v-if="$doc.content" class="bg-white px-4 py-5 sm:px-6 rounded-t-xl">
    <div class="flex space-x-3">
      <div class="min-w-0 flex-1">
        <p class="text-sm font-medium text-gray-900">
          <a href="#" class="hover:underline">Documents</a>
        </p>
        <p class="text-sm text-gray-500">
          <a href="#" class="hover:underline">{{ $doc.content.length }} total of files. {{ formatBytes(size) }}</a>
        </p>
      </div>
      <div class="flex flex-shrink-0 self-center">
        <span class="isolate inline-flex rounded-md shadow-sm">
          <button type="button" class="relative -ml-px inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:z-10 focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500">
            <PlusIcon class="h-5 w-5 mr-1" aria-hidden="true" />
            Add File
          </button>
        </span>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { computed } from 'vue'
import { useDocumentAuthStore } from '@/store/auth/DocumentAuthStore'
import { formatBytes } from '@/helpers/Converter'
import { PlusIcon } from '@heroicons/vue/20/solid'

const $doc = useDocumentAuthStore();
const size = computed(() => $doc.content.reduce((sum, item) => sum + parseInt(item.size.toFixed()), 0))
</script>
