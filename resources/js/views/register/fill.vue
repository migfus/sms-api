<template>
  <div class='h-full'>
    <div class="grid min-h-full justify-center py-8">
      <div class="sm:mx-auto sm:w-full sm:max-w-md mb-8">
        <!-- <object class="mx-auto h-40 w-auto" data="/images/logo-anim.svg" alt="Your Company" /> -->
        <h2 class="text-center text-3xl font-bold tracking-tight text-gray-900">Lastly Fill-Up</h2>
      </div>

      <Form v-slot="{ errors }" :validation-schema="schema" @submit="$register.RegisterAPI()">
        <div class="bg-white px-4 py-5 shadow sm:rounded-xl sm:p-6 mb-2">

            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Personal Information</h3>
                    <p class="mt-1 text-sm text-gray-500">These information are required by the HRMO, CMU.</p>
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
                            <AppInput v-model="$register.params.mid_name" placeholder="Full Middle Name" name="mid_name" :errors="errors"/>
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
                            <AppSelect v-model="$register.params.civil_status_id" placeholder="Civil Status" name="civil_status" :errors="errors">
                                <option :value="549717001907709">Single</option>
                                <option :value="549717001913612">Married</option>
                                <option :value="549717001921661">Separated</option>
                                <option :value="549717001931074">Widowed</option>
                            </AppSelect>
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <AppInput v-model="$register.params.birth_day" placeholder="Birth Day" name="bday" type="date" :errors="errors"/>
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="country" class="block text-sm font-medium text-gray-700">Birth Place (Province)</label>
                            <select v-model="bday_province_id" id="bday_province" name="bday_province" class="mt-1 block w-full rounded-xl border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-primary-500 focus:outline-none focus:ring-primary-500 sm:text-sm">
                                <option v-for="row in $address.content" :key="row.id" :value="row.id">{{ row.name }}</option>
                            </select>
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <AppSelect v-model="$register.params.birth_place_id" placeholder="Birth Place (City)" name="bplace_city" :errors="errors">
                                <option v-if="!bday_province_id" value="1">Select Province</option>
                                <option v-for="row in $address.content.find(item => item.id === bday_province_id).cities" :key="row.id" :value="row.id">{{ row.name }}</option>
                            </AppSelect>
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <AppSelect v-model="$register.params.blood_type_id" placeholder="Blood Type" name="blood_type" :errors="errors">
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

                        <div class="col-span-6 sm:col-span-3">
                            <AppSelect v-model="$register.params.sex" placeholder="Sex" name="sex" :errors="errors">
                                <option :value="true">Male</option>
                                <option :value="false">Female</option>
                            </AppSelect>
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <AppInput v-model="$register.params.height" :placeholder="`Height (meter)${foot_inch}`" name="height" :errors="errors"/>
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <AppInput v-model="$register.params.weight" :placeholder="`Weight (kilo)${pound}`" name="weight" :errors="errors"/>
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="country" class="block text-sm font-medium text-gray-700">Address (Province)</label>
                            <select v-model="address_province_id" id="country" name="country" autocomplete="country-name" class="mt-1 block w-full rounded-xl border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-primary-500 focus:outline-none focus:ring-primary-500 sm:text-sm">
                                <option v-for="row in $address.content" :key="row.id" :value="row.id">{{ row.name }}</option>
                            </select>
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <AppSelect v-model="$register.params.address_id" placeholder="Address (City)" name="address_city" :errors="errors">
                                <option v-if="!address_province_id" value="1">Select Province</option>
                                <option v-for="row in $address.content.find(item => item.id === address_province_id).cities" :key="row.id" :value="row.id">{{ row.name }}</option>
                            </AppSelect>
                        </div>

                        <div class="col-span-6">
                            <AppInput v-model="$register.params.address" placeholder="Address (Street, Purok)" name="address" :errors="errors"/>
                        </div>

                        <div class="col-span-6">
                            <AppInput v-model="$register.params.mobile" placeholder="Mobile Phone" name="mobile" :errors="errors"/>
                        </div>

                    </div>
                </div>
            </div>

            <div class="flex justify-end mt-8 gap-1">
                <AppButton type="submit" color='success' :disabled="Object.keys(errors).length != 0">Register</AppButton>
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
import { useRouter } from 'vue-router'
import { useAddressStore } from '@/store/system/AddressStore'
import { ref, computed } from 'vue'

import AppButton from '@/components/form/AppButton.vue'
import AppInput from '@/components/form/AppInput.vue'
import AppSelect from '@/components/form/AppSelect.vue'

configure({
    validateOnInput: true
})

const $register = useRegisterStore()
const $router = useRouter()
const $address = useAddressStore()

if(!$register.params.email || !$register.params.password) {
  $router.push({name: 'register'})
}

const schema = Yup.object({
    last_name: Yup.string().required('Last name is required'),
    first_name: Yup.string().required('First name is required'),

    bday: Yup.date().typeError('Invalid Date').required('Date is Required'),
    // bplace_city: Yup.string().required('Birth Place is required'),
    height: Yup.string().required('Height is required'),
    weight: Yup.string().required('Weight is required'),

    address: Yup.string().required('Address is required'),
})

const bday_province_id = ref(16)
const address_province_id = ref(16)
const foot_inch = computed(() => {
  if($register.params.height > 0)
    return ` - ${Math.floor($register.params.height * 3.28084)}' ${Math.floor((($register.params.height * 3.28084) - Math.floor($register.params.height * 3.28084))*12)}"`

  return ''
})
const pound = computed(() => {
  if($register.params.weight > 0)
    return ` - ${Math.floor($register.params.weight * 2.20462)} lb`

  return ''
})
</script>
