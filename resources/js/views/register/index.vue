<template>
  <div class='h-full'>
    <div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8 col-start-1 col-span-3 lg:col-span-1 lg:col-start-2">
      <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <object class="mx-auto h-40 w-auto" data="/images/logo-anim.svg" alt="Your Company" />
        <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Register</h2>
      </div>

      <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
          <Form v-slot="{ errors }" :validation-schema="schema" @submit="$register.Next()" class="space-y-6">
            <div>
                <AppInput v-model="$register.params.email" placeholder="Email" name="email" :errors="errors"/>
            </div>

            <div>
              <AppInput v-model="$register.params.password" placeholder="Password" name="password" type="password" :errors="errors"/>
            </div>

            <div>
              <AppInput v-model="$register.params.confirm_password" placeholder="Confirm Password" name="confirm_password" type="password" :errors="errors"/>
            </div>

            <div class="flex items-center justify-between">
              <div class="flex items-center">
                <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-primary-600 focus:ring-primary-500" />
                <label for="remember-mee" class="ml-2 block text-sm text-gray-900">Agree to <RouterLink :to="{name: 'terms-agreement'}" class="text-gray-500 font-bold">Terms & Agreement</RouterLink></label>
              </div>

              <div class="text-sm">
                <RouterLink :to="{name: 'login'}" class="font-medium text-primary-600 hover:text-primary-500">Already Registered?</RouterLink>
              </div>
            </div>

            <div>
              <AppButton type="submit" color='success' block :disabled="Object.keys(errors).length != 0" :loading="$register.config.loading">Register</AppButton>
            </div>
          </Form>

        </div>
      </div>
    </div>
  </div>

</template>

<script setup lang="ts">
import { useRegisterStore } from '@/store/@auth/RegisterStore'
import * as Yup from 'yup'
import { Form, configure } from 'vee-validate'

import AppButton from '@/components/form/AppButton.vue'
import AppInput from  '@/components/form/AppInput.vue'

configure({
    validateOnInput: true
})

const $register = useRegisterStore();

const schema = Yup.object({
    email: Yup.string().required('Email is Required').email('Invalid Email'),
    password: Yup.string().required('Password is required').min(8, 'Minimum of 8 characters'),
    confirm_password: Yup.string().oneOf([Yup.ref('password')], 'Password must match').required('Confirm Password is Required')
})
</script>
