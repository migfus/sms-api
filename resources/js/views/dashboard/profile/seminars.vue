<template>
  <div>
    <Layout>
      <div class="divide-y divide-gray-200 lg:col-span-9">
        <!-- SECTION FORMS -->
        <BasicTransition>
          <!-- NOTE ADD -->
          <FormCard
            v-if="$seminars.config.form == 'create'"
            title="Add Seminar"
            :formSchema="schema"
            :loading="$seminars.config.buttonLoading"
            submitButtonName="Create"
            @submitForm="$seminars.PostAPI()"
            @cancelClick="$seminars.ChangeForm(null)"
            v-slot="{errors}"
          >
            <div class="col-span-4">
              <AppInput v-model="$seminars.params.name" placeholder="Seminar Name" name="name" :errors="errors"/>
            </div>
            <div class="col-span-4">
              <AppSelect v-model="$seminars.params.seminar_type_id" placeholder="Seminar Type" name="type" :errors="errors">
                <option v-for="row in $seminarType.content" :key="row.id" :value="row.id">{{ row.name }}</option>
              </AppSelect>
            </div>

            <div class="col-span-4">
                <AppInput v-model="$seminars.params.hours" placeholder="Hours taken" name="hours" type="number" :errors="errors"/>
            </div>

            <div class="col-span-3">
                <AppInput v-model="$seminars.params.from" placeholder="From Date" name="from" type="date" :errors="errors"/>
            </div>
            <div class="col-span-3">
                <AppInput v-model="$seminars.params.to" placeholder="To Date" name="to" type="date" :errors="errors"/>
            </div>

            <div class="col-span-6">
                <AppInput v-model="$seminars.params.sponsor" placeholder="Sponsor" name="sponsor" :errors="errors"/>
            </div>
          </FormCard>
          <!-- NOTE UPDATE -->
          <FormCard
            v-if="$seminars.config.form == 'update'"
            v-slot="{errors}" title="Update Seminar"
            :formSchema="schema_update"
            :loading="$seminars.config.buttonLoading"
            submitButtonName="Update"
            @submitForm="$seminars.UpdateAPI()"
            @cancelClick="$seminars.ChangeForm(null)"
          >
            <div class="col-span-4">
              <AppInput v-model="$seminars.params.name" placeholder="Seminar Name" name="name" :errors="errors"/>
            </div>
            <div class="col-span-4">
              <AppSelect v-model="$seminars.params.seminar_type_id" placeholder="Seminar Type" name="type" :errors="errors">
                <option v-for="row in $seminarType.content" :key="row.id" :value="row.id">{{ row.name }}</option>
              </AppSelect>
            </div>

            <div class="col-span-4">
                <AppInput v-model="$seminars.params.hours" placeholder="Hours taken" name="hours" type="number" :errors="errors"/>
            </div>

            <div class="col-span-3">
                <AppInput v-model="$seminars.params.from" placeholder="From Date" name="from" type="date" :errors="errors"/>
            </div>
            <div class="col-span-3">
                <AppInput v-model="$seminars.params.to" placeholder="To Date" name="to" type="date" :errors="errors"/>
            </div>


            <div class="col-span-6">
                <AppInput v-model="$seminars.params.sponsor" placeholder="Sponsor" name="sponsor" :errors="errors"/>
            </div>
          </FormCard>
        </BasicTransition>

        <!-- SECTION CONTENT -->
        <ContentCard
          title="Seminars"
          :form="$seminars.config.form"
          :contentLoading="$seminars.config.contentLoading"
          :buttonLoading="$seminars.config.buttonLoading"
          @actionCreateClick="$seminars.ChangeForm(null, 'create')"
          @actionCancelClick="$seminars.ChangeForm(null)"
        >
          <template #search>
            <AppInput v-model="$seminars.query.search" name="search" placeholder="Search" noLabel/>
          </template>

          <template #default>
            <DataTransition>
              <li v-for="row in $seminars.content" :key="row.id">
                <div class="block hover:bg-gray-50">
                  <div class="px-4 py-4 sm:px-6">
                    <div class="flex items-center justify-between">
                      <p class="truncate text-sm font-medium text-primary-600">{{ row.name }}</p>
                      <div class="ml-2 flex flex-shrink-0">
                        <AppButton @click="$seminars.ChangeForm(row, 'update')" color='white' class="mr-2" size="sm" :loading="$seminars.config.buttonLoading">Edit</AppButton>
                        <AppButton @click="showPrompt = true; $seminars.SetIDToDelete(row.id)" color='danger' size="sm" :loading="$seminars.config.buttonLoading">Remove</AppButton>
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
            </DataTransition>

          </template>
        </ContentCard>
    </div>
  </Layout>
</div>

<PromptModal title="Remove this Number?" confirmButtonName="Remove" @confirm="$seminars.DestroyAPI()" v-model="showPrompt">
  <p class="text-gray-500">Are you sure you want to remove this number? This action cannot be undone.</p>
</PromptModal>
</template>

<script setup lang="ts">
import { onMounted, ref, watch } from 'vue'
import * as Yup from 'yup'
import { useSeminarStore } from '@/store/@applicant/SeminarStore'
import { useSeminarTypeStore } from '@/store/system/SeminarTypeStore'
import { CalendarIcon, ClockIcon, LinkIcon, MegaphoneIcon } from '@heroicons/vue/24/outline'
import moment from 'moment'
import { useDebounceFn } from '@vueuse/core'

import Layout from     './~Components/Layout.vue'
import ContentCard from'./~Components/ContentCard.vue'
import FormCard from   './~Components/FormCard.vue'
import AppInput from    '@/components/form/AppInput.vue'
import PromptModal from '@/components/modals/PromptModal.vue'
import AppButton from   '@/components/form/AppButton.vue'
import BasicTransition from '@/components/transitions/BasicTransition.vue'
import DataTransition from '@/components/transitions/DataTransition.vue'
import AppSelect from   '@/components/form/AppSelect.vue'

const schema = Yup.object({
    name: Yup.string().required('Seminar name is required'),
    type: Yup.string().required('Seminar type is required'),
    from: Yup.date().typeError('Invalid Date').required('From date is Required'),
    to: Yup.date().typeError('Invalid Date').required('To date is Required'),
    hours: Yup.number().required('Hours is required').min(1, 'Minimum of 1 hour'),
    sponsor: Yup.string().required('Sponsor is required'),
})
const schema_update = schema

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
  $seminars.GetAPI()
})

watch($seminars.query, useDebounceFn(() => {
  $seminars.GetAPI()
}, 600))
</script>
