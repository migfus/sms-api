<template>
  <button type="button" class="ml-2 shadow focus:shadow-none relative inline-flex items-center rounded-md border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
    <component :is="icon" class="h-5 w-5 mr-1" aria-hidden="true" />
    <slot>

    </slot>
  </button>
</template>

<script setup lang="ts">
import { toRefs } from 'vue'
const $props = defineProps<{
  icon: any,
}>()

const { icon } = toRefs($props)
</script>
