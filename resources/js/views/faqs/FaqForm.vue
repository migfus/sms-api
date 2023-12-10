<!-- This example requires Tailwind CSS v3.0+ -->
<template>
  <div v-if="config.submitted" class="mx-auto max-w-7xl py-6 px-10 lg:px-8 bg-white m-4 rounded-xl shadow">
    <div class="mx-auto text-left">
      <h2 class="text-2xl font-bold leading-10 tracking-tight text-gray-900">
        Thank you for your contribution. <HeartIcon class="mr-2 h-6 w-6 text-red-400" aria-hidden="true" />
      </h2>
    </div>
  </div>

  <div v-else class="mx-auto max-w-7xl py-6 px-10 lg:px-8 bg-white m-4 rounded-xl shadow">
    <Form v-slot="{ errors }" :validation-schema="schema" >
      <div class="mx-auto max-w-2xl text-left">
        <h2 class="text-2xl font-bold leading-10 tracking-tight text-gray-900">Cant' find questions?</h2>
        <p class="mt-4 text-base leading-7 text-gray-600">OHRM Staff will moderate your question before publishing. That will depends on your question.</p>

        <div class="mt-4">
          <AppTextArea name='question' placeholder='Question' />
        </div>

        <div class="sm:col-span-3 mt-4">
          <AppInput name='email' placeholder='Email' />
        </div>

      </div>


      <div class="py-4 text-end">
        <span class="isolate inline-flex rounded-md shadow-sm mt-1">
          <AppButton type="submit" color="white" :disabled="Object.keys(errors).length != 0">
            Submit
          </AppButton>
        </span>
      </div>
    </Form>

  </div>
</template>

<script setup lang="ts">
import { reactive } from 'vue'
import { HeartIcon } from '@heroicons/vue/20/solid'
import {Form, configure } from 'vee-validate'
import * as Yup from 'yup'

import AppButton from '@/components/form/AppButton.vue'
import AppInput from '@/components/form/AppInput.vue'
import AppTextArea from '@/components/form/AppTextArea.vue'

interface paramsInt {
  question: string
  email: string
  phone: string
}

configure({
  validateOnInput: true
})

const schema = Yup.object({
  email: Yup.string().email("Invalid Email")
})


interface configInt {
  submitted: boolean
}

const params = reactive<paramsInt>({
  question: '',
  email: '',
  phone: '',
});

const config = reactive<configInt>({
  submitted: false,
});
</script>
