<template>
  <div class='h-full'>
    <div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8 col-start-1 col-span-3 lg:col-span-1 lg:col-start-2">
      <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <object class="mx-auto h-40 w-auto" data="/images/logo-anim.svg" alt="Your Company" />
        <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Recover your account</h2>
      </div>

      <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
          <Form class="space-y-6" v-slot="{ errors }" :validation-schema="schema" @submit="$forgot.PostAPI()">
            <div>
              <AppInput v-model="$forgot.params.email" name="email" placeholder="Email" :errors="errors"/>
            </div>

            <div class="flex items-center justify-between">

              <div class="text-sm">
                <RouterLink :to="{name: 'login'}" class="font-medium text-primary-600 hover:text-primary-500">Back to Login</RouterLink>
              </div>
            </div>

            <div>
              <AppButton type="submit" block :loading="$forgot.config.buttonLoading">Send Recovery Link</AppButton>
            </div>
          </Form>


        </div>
      </div>
    </div>
  </div>

</template>

<script setup lang="ts">
import { useForgotStore } from '@/store/@auth/ForgotStore'
import * as Yup from 'yup'
import { Form, configure } from 'vee-validate'

import AppButton from '@/components/form/AppButton.vue'
import AppInput from  '@/components/form/AppInput.vue'

configure({
    validateOnInput: true
})

const $forgot = useForgotStore()

const schema = Yup.object({
    email: Yup.string().required("Email is required").email("Invalid Email")
})
</script>
