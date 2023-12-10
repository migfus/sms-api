<template>
  <div class='h-full'>
    <div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8 col-start-1 col-span-3 lg:col-span-1 lg:col-start-2">
      <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <object class="mx-auto h-40 w-auto" data="/images/logo-anim.svg" alt="Your Company" />
        <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Sign in to your account</h2>
      </div>

      <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
          <Form v-slot="{errors}" class="space-y-6" :validation-schema="schema" @submit="$auth.LoginAPI(input)">
            <div>
              <AppInput v-model="input.email" name="email" placeholder="Email" :errors="errors"/>
            </div>

            <div>
              <AppInput v-model="input.password" type="password" name="password" placeholder="Password" :errors="errors"/>
            </div>

            <div class="flex items-center justify-between">
              <div class="flex items-center">
                <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-primary-600 focus:ring-primary-500" />
                <label for="remember-me" class="ml-2 block text-sm text-gray-900">Remember me</label>
              </div>

              <div class="text-sm">
                <RouterLink :to="{name: 'forgot'}" class="font-medium text-primary-600 hover:text-primary-500">Forgot your password?</RouterLink>
              </div>
            </div>

            <div>
              <AppButton block :loading="$auth.config.loading" type="submit" :disabled="Object.keys(errors).length != 0">
                Login
              </AppButton>
            </div>
          </Form>


        </div>
      </div>
    </div>
  </div>

</template>

<script setup lang="ts">
import { useAuthStore } from '@/store/@auth/AuthStore'
import { reactive, onMounted } from 'vue'
import { useRoute } from 'vue-router'
import { Form, configure } from 'vee-validate'
import * as Yup from 'yup'

import AppButton from '@/components/form/AppButton.vue'
import AppInput from '@/components/form/AppInput.vue'

const $auth = useAuthStore()
const $route = useRoute()

configure({
  validateOnInput: true
})

interface InputInt {
  email: string
  password: string
}

const schema = Yup.object({
  email: Yup.string().required('Email is required').email('Invalid Email'),
  password: Yup.string().required('Password is requried')
})

const input = reactive<InputInt>({
  email: '',
  password: '',
});


onMounted(() => {
  if($route.query.email) {
    input.email = $route.query.email.toString() ?? ''
  }
})
</script>
