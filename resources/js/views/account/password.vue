<template>
  <div>
    <Layout>
      <Form v-slot="{ errors }" :validation-schema="schema" @submit="$pass.PostAPI()" class="divide-y divide-gray-200 lg:col-span-9">
        <!-- Profile section -->
        <div class="py-6 px-4 sm:p-6 lg:pb-8 bg-white rounded-xl shadow mb-2">
          <div>
            <h2 class="text-lg font-medium leading-6 text-gray-900">Update Password</h2>
          </div>

          <div class="mt-6 flex flex-col lg:flex-row">
            <div class="flex-grow space-y-6">
              <div class="grid grid-cols-2 gap-2">
                <div class="col-span-2">
                  <AppInput v-model="$pass.params.old_pass" placeholder="Current Password" name="old_pass" type="password" :errors="errors"/>
                </div>
                <div class="">
                  <AppInput v-model="$pass.params.pass" placeholder="New Password" name="pass" type="password" :errors="errors"/>
                </div>
                <div class="">
                  <AppInput v-model="$pass.params.confirm_pass" placeholder="Confirm Password" name="confirm_pass" type="password" :errors="errors"/>
                </div>

              </div>
            </div>

          </div>

          <div class="flex justify-end mt-8 gap-1">
            <AppButton type="submit" color='white' :disabled="Object.keys(errors).length != 0" :loading="$pass.config.buttonLoading">Update</AppButton>
          </div>
        </div>
      </Form>
  </Layout>
</div>
</template>

<script setup lang="ts">
import * as Yup from 'yup'
import { Form, configure } from 'vee-validate'
import { usePasswordStore } from '@/store/@applicant/PasswordStore'

import AppInput from '@/components/form/AppInput.vue'
import Layout from './~Components/Layout.vue'
import AppButton from '@/components/form/AppButton.vue'

configure({
    validateOnInput: true
})

const schema = Yup.object({
    old_pass: Yup.string().required('Current Password is required'),
    pass: Yup.string().required('New Password is required'),
    confirm_pass: Yup.string().oneOf([Yup.ref('pass')], 'Password must match').required('Confirm Password is Required')
})

const $pass = usePasswordStore()
</script>
