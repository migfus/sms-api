<template>
  <div class='h-full grid grid-cols-1'>
    <div class="grid grid-cols-1 py-8 justify-items-center">
      <div class="sm:mx-auto sm:w-full sm:max-w-md mb-8">
        <!-- <object class="mx-auto h-40 w-auto" data="/images/logo-anim.svg" alt="Your Company" /> -->
        <h2 class="text-center text-3xl font-bold tracking-tight text-gray-900">Confirmation</h2>
      </div>

      <Form v-slot="{ errors }" :validation-schema="schema" @submit="$register.RegisterAPI()" class="w-full md:max-w-7xl">
        <div class="bg-white px-4 py-5 shadow sm:rounded-xl sm:p-6 mb-2">

            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">

                  <div class="mt-1 sm:col-span-2 sm:mt-0">
                    <div class="flex max-w-lg justify-center rounded-md border-2 border-dashed border-gray-300 px-6 pt-5 pb-6">
                      <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                          <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600">
                          <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-medium text-primary-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-primary-500 focus-within:ring-offset-2 hover:text-primary-500">
                            <span>Upload a file</span>
                            <input id="file-upload" name="file-upload" type="file" class="sr-only" />
                          </label>
                          <p class="pl-1">or drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500">PNG, JPG, GIF up to 5MB</p>
                      </div>
                    </div>
                  </div>


                </div>
                <div class="mt-5 md:col-span-2 md:mt-0">

                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-3">
                            <AppInput v-model="$register.params.last_name" placeholder="Last Name" name="last_name" :errors="errors"/>
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <AppInput v-model="$register.params.first_name" placeholder="First Name" name="first_name" :errors="errors"/>
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <AppInput v-model="$register.params.mid_name" placeholder="Middle Initial Name" name="mid_name" :errors="errors"/>
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <AppSelect v-model="$register.params.ext_name" placeholder="Extension Name" name="ext_name" :errors="errors">
                                <option value="">n/a</option>
                                <option value="JR">JR.</option>
                                <option value="SR">SR.</option>
                                <option value="II">II.</option>
                                <option value="III">III.</option>
                                <option value="IV">IV.</option>
                            </AppSelect>
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                          <AppSelect v-model="$register.params.department_id" placeholder="Department" name="department" :errors="errors">
                            <option :value="549717001907709">Engineering</option>
                            <option :value="549717001913612">Mathematics</option>
                            <option :value="549717001921661">Separated</option>
                            <option :value="549717001931074">Widowed</option>
                          </AppSelect>
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                          <AppSelect v-model="$register.params.unit_id" placeholder="Unit/College" name="unit" :errors="errors">
                            <option :value="549717001907709">Engineering</option>
                            <option :value="549717001913612">Mathematics</option>
                            <option :value="549717001921661">Separated</option>
                            <option :value="549717001931074">Widowed</option>
                          </AppSelect>
                        </div>

                        <div class="col-span-6">
                            <AppInput v-model="$register.params.position" placeholder="Position" name="position" :errors="errors"/>
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <AppInput v-model="$register.params.mobile" placeholder="Email" name="mobile" :errors="errors"/>
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <AppInput v-model="$register.params.email" placeholder="Mobile Number" name="email" :errors="errors"/>
                        </div>

                    </div>
                </div>
            </div>

            <div class="flex justify-end mt-8 gap-1">
                <AppButton type="submit" color='success' :disabled="Object.keys(errors).length != 0" :loading="$register.config.buttonLoading">Register</AppButton>
                <!-- <AppButton @click="$user.ChangeForm()" color="white">Cancel</AppButton> -->
            </div>

        </div>
    </Form>
    </div>
  </div>

</template>

<script setup lang="ts">
import { useRegisterStore } from '@/store/@auth/RegisterStore'
import * as Yup from 'yup'
import { Form, configure } from 'vee-validate'

import AppButton from '@/components/form/AppButton.vue'
import AppInput from  '@/components/form/AppInput.vue'
import AppSelect from '@/components/form/AppSelect.vue'

configure({
    validateOnInput: true
})

const $register = useRegisterStore()

const schema = Yup.object({
    last_name: Yup.string().required('Last name is required'),
    first_name: Yup.string().required('First name is required'),

    department: Yup.string().required('Department/College is required'),
    unit: Yup.string().required("Unit is required"),
    position: Yup.string().required('Position is required'),
    email: Yup.string().email('Invalid email')
})
</script>
