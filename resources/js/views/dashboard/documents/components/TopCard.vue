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
          <ButtonComp :icon="PlusIcon">
            Add File
          </ButtonComp>
        </span>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { computed } from 'vue'
import { useDocumentAuthStore } from '@/store/@applicant/DocumentAuthStore'
import { formatBytes } from '@/helpers/Converter'
import { PlusIcon } from '@heroicons/vue/20/solid'

import ButtonComp from '@/components/form/AppButton.vue'

const $doc = useDocumentAuthStore();
const size = computed(() => $doc.content.reduce((sum, item) => sum + parseInt(item.size.toFixed()), 0))
</script>
