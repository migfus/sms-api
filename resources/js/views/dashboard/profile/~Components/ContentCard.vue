<template>
  <h2 class="bg-white mb-3 rounded-xl p-5 shadow font-bold text-gray-600 grid grid-cols-12">
    <div class="col-span-6 mt-1">
      {{ $props.title }}
    </div>
    <div class="col-span-6">
      <slot name="search"></slot>
    </div>
  </h2>

  <div class="px-4 sm:p-0 lg:pb-8">

    <div class="overflow-hidden bg-white shadow sm:rounded-xl mb-3">
      <ul role="list" class="divide-y divide-gray-200">
        <slot></slot>
      </ul>
    </div>

    <div class="flex justify-end gap-1 bg-white py-4 px-6 rounded-xl shadow">
      <AppButton color='white' :loading="$props.contentLoading || $props.buttonLoading" class="mr-1">Generate PDS</AppButton>
      <AppButton v-if="$props.form == '' || $props.form == null" @click="$emit('actionCreateClick')" color='white' :loading="$props.contentLoading || $props.buttonLoading">Add</AppButton>
      <AppButton v-else @click="$emit('actionCancelClick')" color='danger' :loading="$props.contentLoading || $props.buttonLoading">Cancel</AppButton>
    </div>
  </div>
</template>

<script setup lang="ts">
import AppButton from '@/components/form/AppButton.vue'


const $props = defineProps<{
  title: string
  form: string
  contentLoading: boolean
  buttonLoading: boolean
}>()
const $emit = defineEmits(['actionCreateClick', 'actionCancelClick', 'update:modelValue'])
</script>
