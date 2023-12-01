<template>
  <main  class="relative">
    <div class="mx-auto max-w-screen-xl pb-3">
      <div class="overflow-hidden rounded-xl bg-white shadow">
        <Form v-slot="{ errors }" :validation-schema="$props.formSchema" @submit="$emit('submitForm')" class="rounded-xl divide-y divide-gray-200 lg:col-span-9">
          <div class="py-6 px-4 sm:p-6 lg:pb-8">
            <div>
              <h2 class="text-lg font-medium leading-6 text-gray-900">{{  $props.title }}</h2>
            </div>
            <div class="mt-6">
              <div class="grid grid-cols-12 gap-2">
                <slot :errors="errors"></slot>

                <div class="flex justify-end mt-3 gap-1 col-span-12">
                  <AppButton type="submit" color='white' :disabled="Object.keys(errors).length != 0" :loading="$props.loading">{{ $props.submitButtonName }}</AppButton>
                  <AppButton @click="$emit('cancelClick')" color='danger' :loading="$props.loading">Cancel</AppButton>
                </div>
              </div>
            </div>

          </div>

        </Form>
      </div>
    </div>
  </main>
</template>

<script setup lang="ts">
import { Form, configure } from 'vee-validate'

import AppButton from '@/components/form/AppButton.vue'

configure({
    validateOnInput: true
})

const $props = defineProps<{
  title: string
  formSchema: any
  submitButtonName: string
  loading: boolean
}>()
const $emit = defineEmits(['submitForm', 'cancelClick'])
</script>

<style scoped>

</style>
