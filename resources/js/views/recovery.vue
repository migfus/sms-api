<template>
  <div class='h-full'>
    <div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8 col-start-1 col-span-3 lg:col-span-1 lg:col-start-2">
      <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <img class="mx-auto h-24 w-auto" :src="logo" alt="Your Company" />
        <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Recover your account</h2>
      </div>

      <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
          <Form v-slot="{ errors }" :validation-schema="schema" @submit="$recover.PostAPI()"  class="space-y-6">
            <div>
              <AppInput v-model="$recover.params.code" name="code" placeholder="Code" :errors="errors"/>
            </div>

            <div>
              <AppInput v-model="$recover.params.password" name="password" placeholder="Password" type="password" :errors="errors"/>
            </div>

            <div>
              <AppInput v-model="$recover.params.confirm_password" name="confirm_password" placeholder="Confirm Password" type="password" :errors="errors"/>
            </div>

            <div class="flex items-center justify-between">

              <div class="text-sm">
                <RouterLink :to="{name: 'login'}" class="font-medium text-primary-600 hover:text-primary-500">Back to Login</RouterLink>
              </div>
            </div>

            <div>
              <AppButton type="submit" block>Change Password</AppButton>
            </div>
          </Form>

        </div>
      </div>
    </div>
  </div>

</template>

<script setup lang="ts">
import { onMounted } from 'vue'
import { useRoute } from 'vue-router'
import { useRecoveryStore } from '@/store/@auth/RecoveryStore'
import * as Yup from 'yup'
import { Form, configure } from 'vee-validate'

import logo from '@/assets/images/logo.png'
import AppInput from '@/components/form/AppInput.vue'
import AppButton from '@/components/form/AppButton.vue'

configure({
    validateOnInput: true
})

const $recover = useRecoveryStore()
const $route = useRoute()

const schema = Yup.object({
    code: Yup.string().required('Code is required'),
    password: Yup.string().required('Password is required'),
    confirm_password: Yup.string().oneOf([Yup.ref('password')], 'Password must match').required('Confirm Password is Required')
})

onMounted(() => {
  $recover.params.code = $route.query.code.toString()!
});
</script>
