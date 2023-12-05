<template>
  <div class="flex justify-end gap-1 bg-white py-4 px-6 rounded-xl shadow">
    <AppButton v-if="$props.form == null" @click="$emit('createClick')" color='white'>Create</AppButton>
    <AppButton v-else @click="$emit('cancelClick')" color='white'>Cancel</AppButton>
  </div>
</template>

<script setup lang="ts">
import AppButton from '@/components/form/AppButton.vue'

const $props = defineProps<{
  form?: string
}>()
const $emit = defineEmits(['createClick', 'cancelClick'])

</script>
