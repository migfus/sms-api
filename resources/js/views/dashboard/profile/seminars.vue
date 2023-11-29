<template>
  <div>
    <BasicTransition>
      <main v-if="$seminars.config.form == 'create'" class="relative">
        <div class="mx-auto max-w-screen-xl pb-3">
          <div class="overflow-hidden rounded-xl bg-white shadow">
              <Form v-slot="{ errors }" :validation-schema="schema" @submit="$seminars.PostAPI()" class="rounded-xl divide-y divide-gray-200 lg:col-span-9">
                <div class="py-6 px-4 sm:p-6 lg:pb-8">
                  <div>
                    <h2 class="text-lg font-medium leading-6 text-gray-900">Add Seminar</h2>
                  </div>
                  <div class="mt-6 grid grid-cols-6 lg:flex-row gap-2">

                      <div class="col-span-3">
                          <AppInput v-model="$seminars.params.name" placeholder="Seminar Name" name="name" :errors="errors"/>
                      </div>
                      <div class="col-span-3">
                        <AppSelect v-model="$seminars.params.seminar_type_id" placeholder="Seminar Type" name="type" :errors="errors">
                          <option v-for="row in $seminarType.content" :key="row.id" :value="row.id">{{ row.name }}</option>
                        </AppSelect>
                      </div>

                      <div class="col-span-2">
                          <AppInput v-model="$seminars.params.from" placeholder="From Date" name="from" type="date" :errors="errors"/>
                      </div>
                      <div class="col-span-2">
                          <AppInput v-model="$seminars.params.to" placeholder="To Date" name="to" type="date" :errors="errors"/>
                      </div>
                      <div class="col-span-2">
                          <AppInput v-model="$seminars.params.hours" placeholder="Hours taken" name="hours" type="number" :errors="errors"/>
                      </div>

                      <div class="col-span-3">
                          <AppInput v-model="$seminars.params.sponsor" placeholder="Sponsor" name="sponsor" :errors="errors"/>
                      </div>

                      <div class="flex justify-end mt-8 gap-1 col-span-6">
                        <AppButton color='white' type="submit" :disabled="Object.keys(errors).length != 0">Create</AppButton>
                        <AppButton @click="$seminars.ChangeForm(null)" color='white'>Cancel</AppButton>
                      </div>

                  </div>
                </div>
              </Form>
          </div>
        </div>
      </main>

      <main v-if="$seminars.config.form == 'update'" class="relative">
        <div class="mx-auto max-w-screen-xl pb-3">
          <div class="overflow-hidden rounded-xl bg-white shadow">
            <Form v-slot="{ errors }" :validation-schema="schema_update" @submit="$seminars.UpdateAPI()" class="rounded-xl divide-y divide-gray-200 lg:col-span-9">
              <div class="py-6 px-4 sm:p-6 lg:pb-8">
                <div>
                  <h2 class="text-lg font-medium leading-6 text-gray-900">Update Skill</h2>
                </div>
                <div class="mt-6 grid grid-cols-6 gap-2">

                  <div class="col-span-3">
                    <AppInput v-model="$seminars.params.name" placeholder="Seminar Name" name="name" :errors="errors"/>
                  </div>
                  <div class="col-span-3">
                    <AppSelect v-model="$seminars.params.seminar_type_id" placeholder="Seminar Type" name="type" :errors="errors">
                      <option v-for="row in $seminarType.content" :key="row.id" :value="row.id">{{ row.name }}</option>
                    </AppSelect>
                  </div>

                  <div class="col-span-2">
                    <AppInput v-model="$seminars.params.from" placeholder="From Date" name="from" type="date" :errors="errors"/>
                  </div>
                  <div class="col-span-2">
                    <AppInput v-model="$seminars.params.to" placeholder="To Date" name="to" type="date" :errors="errors"/>
                  </div>
                  <div class="col-span-2">
                    <AppInput v-model="$seminars.params.hours" placeholder="Hours taken" name="hours" type="number" :errors="errors"/>
                  </div>

                  <div class="col-span-3">
                    <AppInput v-model="$seminars.params.sponsor" placeholder="Sponsor" name="sponsor" :errors="errors"/>
                  </div>

                  <div class="flex justify-end mt-8 gap-1 col-span-6">
                    <AppButton color='white' type="submit" :disabled="Object.keys(errors).length != 0">Update</AppButton>
                    <AppButton @click="$seminars.ChangeForm(null)" color='white'>Cancel</AppButton>
                  </div>

                </div>
              </div>
            </Form>
          </div>
        </div>
      </main>
    </BasicTransition>



    <Layout>
      <Loader v-if="$seminars.config.loading" />
      <div v-else class="divide-y divide-gray-200 lg:col-span-9">

        <h2 class="bg-white mb-3 rounded-xl p-5 shadow font-bold text-gray-600">Seminars</h2>

        <div class="lg:pb-2">

          <div class="overflow-hidden bg-white shadow sm:rounded-xl mb-3">
            <ul role="list" class="divide-y divide-gray-200">
              <li v-for="row in $seminars.content" :key="row.id">
                <div class="block hover:bg-gray-50">
                  <div class="px-4 py-4 sm:px-6">
                    <div class="flex items-center justify-between">
                      <p class="truncate text-sm font-medium text-primary-600">{{ row.name }}</p>
                      <div class="ml-2 flex flex-shrink-0">
                        <AppButton @click="$seminars.ChangeForm(row, 'update')" color='white' class="mr-2">Edit</AppButton>
                        <AppButton @click="showPrompt = true; $seminars.SetIDToDelete(row.id)" color='white'>Remove</AppButton>

                      </div>
                    </div>
                    <div class="mt-2 sm:flex sm:justify-between">
                      <div class="sm:flex">
                        <p class="flex items-center text-sm text-gray-500 mb-2 sm:mb-0">
                          <ClockIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                          {{ hoursDisplay(row.hours) }}
                        </p>
                        <p class="flex items-center text-sm text-gray-500 sm:ml-3 mb-2 sm:mb-0">
                          <LinkIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                          {{ row.seminar_type.name }}
                        </p>
                        <p class="flex items-center text-sm text-gray-500 sm:ml-3 mb-2 sm:mb-0">
                          <MegaphoneIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                          {{ row.sponsor }}
                        </p>
                      </div>
                      <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0 mb-2 sm:mb-0">
                        <CalendarIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                        <p>
                          {{ dateDisplay(row.from, row.to) }}
                        </p>
                      </div>

                    </div>
                  </div>
                </div>
              </li>
            </ul>
          </div>


          <ActionCard :form="$seminars.config.form" @createClick="$seminars.ChangeForm(null, 'create')" @cancelClick="$seminars.ChangeForm(null)"/>

        </div>
      </div>






  </Layout>
</div>

<PromptModal title="Remove this Number?" confirmButtonName="Remove" @confirm="$seminars.DestroyAPI()" v-model="showPrompt">
  <p class="text-gray-500">Are you sure you want to remove this number? This action cannot be undone.</p>
</PromptModal>
</template>

<script setup lang="ts">
import { onMounted, ref } from 'vue'
import * as Yup from 'yup'
import { Form, configure } from 'vee-validate'
import { useSeminarStore } from '@/store/@applicant/SeminarStore'
import { useSeminarTypeStore } from '@/store/system/SeminarTypeStore'
import { CalendarIcon, ClockIcon, LinkIcon, MegaphoneIcon } from '@heroicons/vue/24/outline'
import moment from 'moment'

import AppInput from '@/components/form/AppInput.vue'
import PromptModal from '@/components/modals/PromptModal.vue'
import Layout from './Layout.vue'
import AppButton from '@/components/form/AppButton.vue'
import Loader from './Loader.vue'
import BasicTransition from '@/components/transitions/BasicTransition.vue'
import ActionCard from './ActionCard.vue'
import AppSelect from '@/components/form/AppSelect.vue'

configure({
    validateOnInput: true
})

const schema = Yup.object({
    name: Yup.string().required('Seminar name is required'),
    type: Yup.string().required('Seminar type is required'),
    from: Yup.date().typeError('Invalid Date').required('From date is Required'),
    to: Yup.date().typeError('Invalid Date').required('To date is Required'),
    hours: Yup.number().required('Hours is required').min(1, 'Minimum of 1 hour'),
    sponsor: Yup.string().required('Sponsor is required'),
})
const schema_update = Yup.object({
  name: Yup.string().required('Seminar name is required'),
  type: Yup.string().required('Seminar type is required'),
  from: Yup.date().typeError('Invalid Date').required('From date is Required'),
  to: Yup.date().typeError('Invalid Date').required('To date is Required'),
  hours: Yup.number().required('Hours is required').min(1, 'Minimum of 1 hour'),
  sponsor: Yup.string().required('Sponsor is required'),
})

const $seminars = useSeminarStore()
const $seminarType = useSeminarTypeStore()
const showPrompt = ref(false)

function dateDisplay(from: Date, to: Date) {
  if(moment(from).diff(to, 'days') == 0) {
    return `${moment(from).format('MMM DD, YYYY')} (1 day)`
  }

  return `${moment(from).format('MMM DD, YYYY')} - ${moment(to).format("MMM DD, YYYY")} (${moment(to).diff(from, 'days') + 1} days)`
}

function hoursDisplay(hours: number) {
  if(hours > 1) {
    return `${hours} hrs`
  }
  return `${hours} hr`
}

onMounted(() => {
  $seminarType.GetAPI()
  $seminars.GetAPI()
})
</script>
