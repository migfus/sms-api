<template>
  <div>
  <Layout>

    <Form v-slot="{ errors }" :validation-schema="schema" @submit="submit()" class="divide-y divide-gray-200 lg:col-span-9">
      <!-- Profile section -->
      <div class="py-6 px-4 sm:p-6 lg:pb-8">
        <div>
          <h2 class="text-lg font-medium leading-6 text-gray-900">Personal Info</h2>
        </div>

        <div class="mt-6 flex flex-col lg:flex-row">
          <div class="flex-grow space-y-6">
            <div class="grid grid-cols-2 gap-2">
              <div class="">
                <AppInput v-model="$person.params.last_name" placeholder="Last Name" name="last_name" :errors="errors"/>
              </div>
              <div class="">
                <AppInput v-model="$person.params.first_name" placeholder="First Name" name="first_name" :errors="errors"/>
              </div>
              <div class="">
                <AppInput v-model="$person.params.mid_name" placeholder="Middle Name" name="mid_name" :errors="errors"/>
              </div>
              <div class="">
                <AppSelect v-model="$person.params.ext_name" placeholder="Extension Name" name="ext_name" :errors="errors">
                    <option value="">n/a</option>
                    <option value="JR">JR.</option>
                    <option value="SR">SR.</option>
                    <option value="II">II.</option>
                    <option value="III">III.</option>
                    <option value="IV">IV.</option>
                </AppSelect>
              </div>
              <div>
                <AppSelect v-model="$person.params.civil_status_id" placeholder="Civil Status" name="civil_status" :errors="errors">
                    <option :value="549717001907709">Single</option>
                    <option :value="549717001913612">Married</option>
                    <option :value="549717001921661">Separated</option>
                    <option :value="549717001931074">Widowed</option>
                </AppSelect>
              </div>
              <div>
                  <AppSelect v-model="$person.params.blood_type_id" placeholder="Blood Type" name="blood_type" :errors="errors">
                      <option :value="549716690333042">O+</option>
                      <option :value="549716690340549">O-</option>
                      <option :value="549716690347712">A+</option>
                      <option :value="549716690357634">A-</option>
                      <option :value="549716690365452">B+</option>
                      <option :value="549716690370736">B-</option>
                      <option :value="549716690379297">AB+</option>
                      <option :value="549716690383368">AB-</option>
                  </AppSelect>
              </div>
            </div>
          </div>

          <div class="mt-6 flex-grow lg:mt-0 lg:ml-6 lg:flex-shrink-0 lg:flex-grow-0">
            <p class="text-sm font-medium text-gray-700" aria-hidden="true">Avatar</p>
            <div class="mt-1 lg:hidden">
              <div class="flex items-center">
                <div class="inline-block h-12 w-12 flex-shrink-0 overflow-hidden rounded-full" aria-hidden="true">
                  <img class="h-full w-full rounded-full" :src="user.imageUrl" alt="" />
                </div>
                <div class="ml-5 rounded-md shadow-sm">
                  <div class="group relative flex items-center justify-center rounded-md border border-gray-300 py-2 px-3 focus-within:ring-2 focus-within:ring-sky-500 focus-within:ring-offset-2 hover:bg-gray-50">

                    <input id="mobile-user-photo" name="user-photo" type="file" class="absolute h-full w-full cursor-pointer rounded-md border-gray-300 opacity-0" />
                  </div>
                </div>
              </div>
            </div>

            <div class="relative hidden overflow-hidden rounded-full lg:block">
              <img class="relative h-20 w-20 rounded-full" :src="user.imageUrl" alt="" />
              <label for="desktop-user-photo" class="absolute inset-0 flex h-full w-full items-center justify-center bg-black bg-opacity-75 text-sm font-medium text-white opacity-0 focus-within:opacity-100 hover:opacity-100">
                <span>Change</span>
                <span class="sr-only"> user photo</span>
                <input type="file" id="desktop-user-photo" name="user-photo" class="absolute inset-0 h-full w-full cursor-pointer rounded-md border-gray-300 opacity-0" />

              </label>
            </div>

            <AppButton type="submit" color='white' class="mt-2">Change</AppButton>
          </div>
        </div>

        <div class="mt-6 grid grid-cols-12 gap-6">
          <div class="col-span-6">
              <AppSelect v-model="$person.params.sex" placeholder="Sex" name="sex" :errors="errors">
                  <option :value="true">Male</option>
                  <option :value="false">Female</option>
              </AppSelect>
          </div>

          <div class="col-span-6">
              <AppInput v-model="$person.params.birth_day" placeholder="Birth Day" name="bday" type="date" :errors="errors"/>
          </div>

          <div class="col-span-6">
              <label for="country" class="block text-sm font-medium text-gray-700">Birth Place (Province)</label>
              <select v-model="bday_province_id" id="bday_province" name="bday_province" class="mt-1 block w-full rounded-xl border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-primary-500 focus:outline-none focus:ring-primary-500 sm:text-sm">
                  <option v-for="row in $address.content" :key="row.id" :value="row.id">{{ row.name }}</option>
              </select>
          </div>

          <div class="col-span-6">
              <AppSelect v-model="$person.params.birth_place_id" placeholder="Birth Place (City)" name="bplace_city" :errors="errors">
                  <option v-if="!bday_province_id" value="1">Select Province</option>
                  <option v-for="row in $address.content.find(item => item.id === bday_province_id).cities" :key="row.id" :value="row.id">{{ row.name }}</option>
              </AppSelect>
          </div>

          <div class="col-span-6">
              <AppInput v-model="$person.params.height" :placeholder="`Height (meter)${foot_inch}`" name="height" :errors="errors"/>
          </div>

          <div class="col-span-6">
              <AppInput v-model="$person.params.weight" :placeholder="`Weight (kilo)${pound}`" name="weight" :errors="errors"/>
          </div>

          <div class="col-span-6">
              <label for="country" class="block text-sm font-medium text-gray-700">Address (Province)</label>
              <select v-model="address_province_id" id="country" name="country" autocomplete="country-name" class="mt-1 block w-full rounded-xl border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-primary-500 focus:outline-none focus:ring-primary-500 sm:text-sm">
                  <option v-for="row in $address.content" :key="row.id" :value="row.id">{{ row.name }}</option>
              </select>
          </div>

          <div class="col-span-6">
              <AppSelect v-model="$person.params.address_id" placeholder="Address (City)" name="address_city" :errors="errors">
                  <option v-if="!address_province_id" value="1">Select Province</option>
                  <option v-for="row in $address.content.find(item => item.id === address_province_id).cities" :key="row.id" :value="row.id">{{ row.name }}</option>
              </AppSelect>
          </div>

          <div class="col-span-12">
              <AppInput v-model="$person.params.address" placeholder="Address (Street, Purok)" name="address" :errors="errors"/>
          </div>
        </div>

        <div class="flex justify-end mt-8 gap-1">
          <AppButton type="submit" color='white' :disabled="Object.keys(errors).length != 0">Update</AppButton>
        </div>
      </div>



    </Form>

  </Layout>
</div>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue'
import * as Yup from 'yup'
import { Form, configure } from 'vee-validate'
import { useAddressStore } from '@/store/system/AddressStore'
import { usePersonalStore } from '@/store/@applicant/PersonalStore'

import AppInput from '@/components/form/AppInput.vue'
import Layout from './Layout.vue'
import AppSelect from '@/components/form/AppSelect.vue'
import AppButton from '@/components/form/AppButton.vue'

configure({
    validateOnInput: true
})

const schema = Yup.object({
    last_name: Yup.string().required('Last name is required'),
    first_name: Yup.string().required('First name is required'),

    bday: Yup.date().typeError('Invalid Date').required('Date is Required'),
    // bplace_city: Yup.string().required('Birth Place is required'),
    height: Yup.string().required('Height is required'),
    weight: Yup.string().required('Weight is required'),

    address: Yup.string().required('Address is required'),
})

const user = {
  name: 'Debbie Lewis',
  handle: 'deblewis',
  email: 'debbielewis@example.com',
  imageUrl:
    'https://images.unsplash.com/photo-1517365830460-955ce3ccd263?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=320&h=320&q=80',
}

const $person = usePersonalStore()
const $address = useAddressStore()

const bday_province_id = ref(16)
const address_province_id = ref(16)

const foot_inch = computed(() => {
  if($person.params.height > 0)
    return ` - ${Math.floor($person.params.height * 3.28084)}' ${Math.floor((($person.params.height * 3.28084) - Math.floor($person.params.height * 3.28084))*12)}"`

  return ''
})
const pound = computed(() => {
  if($person.params.weight > 0)
    return ` - ${Math.floor($person.params.weight * 2.20462)} lb`

  return ''
})


function submit() {
  alert('du')
}
</script>
