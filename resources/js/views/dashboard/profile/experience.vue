<template>
  <div>
    <Layout>
      <div class="divide-y divide-gray-200 lg:col-span-9">
        <BasicTransition>
          <!-- NOTE CREATE -->
          <FormCard
            v-if="$exp.config.form == 'create'"
            title="Add Work Experience"
            :formSchema="schema"
            :loading="$exp.config.buttonLoading"
            submitButtonName="Create"
            @submitForm="$exp.PostAPI()"
            @cancelClick="$exp.ChangeForm(null)"
            v-slot="{errors}"
          >
            <div class="col-span-12 sm:col-span-6">
                <AppInput v-model="$exp.params.position" placeholder="Position" name="position" :errors="errors"/>
            </div>
            <div class="col-span-6">
                <AppInput v-model="$exp.params.company" placeholder="Company (Full Name)" name="company" :errors="errors"/>
            </div>

            <div class="col-span-6">
              <AppSelect v-model="$exp.params.work_status_id" placeholder="Work Status" name="work_status" :errors="errors">
                <option v-for="row in $exp_status.content" :key="row.id" :value="row.id">{{ row.name }}</option>
              </AppSelect>
            </div>
            <div class="col-span-6 sm:col-span-3">
                <AppInput v-model="$exp.params.from" placeholder="From" name="from" type="date" :errors="errors"/>
            </div>
            <div class="col-span-6 sm:col-span-3">
                <AppInput v-model="$exp.params.to" placeholder="To (Blank if present)" name="to" type="date" :errors="errors"/>
            </div>

            <div class="col-span-6 sm:col-span-3">
                <AppInput v-model="$exp.params.sg" placeholder="Salary Grade" name="sg" :errors="errors"/>
            </div>
            <div class="col-span-6 sm:col-span-4">
                <AppInput v-model="$exp.params.salary" placeholder="Salary" name="salary" :errors="errors"/>
            </div>
            <div class="col-span-6 sm:col-span-3">
              <AppSelect v-model="$exp.params.salary_type_id" placeholder="Salary Type" name="salary_type" :errors="errors">
                <option v-for="row in $salaryType.content" :value="row.id">{{ row.name }}</option>
              </AppSelect>
            </div>
            <div class="col-span-6 sm:col-span-2">
              <AppSelect v-model="$exp.params.is_government" placeholder="Government" name="government" :errors="errors">
                <option :value="true">Yes</option>
                <option :value="false">No</option>
              </AppSelect>
            </div>
          </FormCard>
          <!-- NOTE UPDATE -->
          <FormCard
            v-if="$exp.config.form == 'update'"
            title="Update Work Experience"
            :loading="$exp.config.buttonLoading"
            :formSchema="schema_update"
            submitButtonName="Update"
            @submitForm="$exp.UpdateAPI()"
            @cancelClick="$exp.ChangeForm(null)"
            v-slot="{errors}"
          >
          <div class="col-span-12 sm:col-span-6">
                <AppInput v-model="$exp.params.position" placeholder="Position" name="position" :errors="errors"/>
            </div>
            <div class="col-span-6">
                <AppInput v-model="$exp.params.company" placeholder="Company (Full Name)" name="company" :errors="errors"/>
            </div>

            <div class="col-span-6">
              <AppSelect v-model="$exp.params.work_status_id" placeholder="Work Status" name="work_status" :errors="errors">
                <option v-for="row in $exp_status.content" :key="row.id" :value="row.id">{{ row.name }}</option>
              </AppSelect>
            </div>
            <div class="col-span-6 sm:col-span-3">
                <AppInput v-model="$exp.params.from" placeholder="From" name="from" type="date" :errors="errors"/>
            </div>
            <div class="col-span-6 sm:col-span-3">
                <AppInput v-model="$exp.params.to" placeholder="To (Blank if present)" name="to" type="date" :errors="errors"/>
            </div>

            <div class="col-span-6 sm:col-span-3">
                <AppInput v-model="$exp.params.sg" placeholder="Salary Grade" name="sg" :errors="errors"/>
            </div>
            <div class="col-span-6 sm:col-span-4">
                <AppInput v-model="$exp.params.salary" placeholder="Salary" name="salary" :errors="errors"/>
            </div>
            <div class="col-span-6 sm:col-span-3">
              <AppSelect v-model="$exp.params.salary_type_id" placeholder="Salary Type" name="salary_type" :errors="errors">
                <option v-for="row in $salaryType.content" :value="row.id">{{ row.name }}</option>
              </AppSelect>
            </div>
            <div class="col-span-6 sm:col-span-2">
              <AppSelect v-model="$exp.params.is_government" placeholder="Government" name="government" :errors="errors">
                <option :value="true">Yes</option>
                <option :value="false">No</option>
              </AppSelect>
            </div>
          </FormCard>
        </BasicTransition>

        <!-- SECTION CONTENT -->
        <ContentCard
          title="Work Experience"
          :form="$exp.config.form"
          :content-loading="$exp.config.contentLoading"
          :button-loading="$exp.config.buttonLoading"
          @actionCreateClick="$exp.ChangeForm(null, 'create')"
          @actionCancelClick="$exp.ChangeForm(null)"
        >
          <template #search>
            <AppInput v-model="$exp.query.search" name="search" placeholder="Search" noLabel/>
          </template>

          <template #default>
            <DataTransition>
              <li v-for="row in $exp.content" :key="row.id">
                <div class="block hover:bg-gray-50">
                  <div class="px-4 py-4 sm:px-6">
                    <div class="flex items-center justify-between">
                      <p :class="['truncate text-sm font-medium text-primary-600', row.is_government && 'text-yellow-600']">
                        {{ row.position }} - {{ row.company }} {{ row.is_government ? `(Gov)` : ''}}
                      </p>
                      <div class="ml-2 flex flex-shrink-0">
                        <AppButton @click="$exp.ChangeForm(row, 'update')" color='white' class="mr-2" size="sm">Edit</AppButton>
                        <AppButton @click="showPrompt = true; $exp.SetIDToDelete(row.id)" color='danger' size="sm">Remove</AppButton>
                      </div>
                    </div>
                    <div class="mt-2 sm:flex sm:justify-between">
                      <div class="sm:flex">
                        <p class="flex items-center text-sm text-gray-500 mb-2 sm:mb-0 mr-2">
                          <BanknotesIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                          {{ NumberAddComma(row.salary) }}
                        </p>
                        <p class="flex items-center text-sm text-gray-500 mb-2 sm:mb-0 mr-2">
                          <TagIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                          {{ row.work_status.name }}
                        </p>

                        <p v-if="row.sg" class="flex items-center text-sm text-gray-500 mb-2 sm:mb-0 mr-2">
                          <StopIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                          {{ `SG ${row.sg}` }}
                        </p>
                      </div>
                      <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0 mb-2 sm:mb-0">
                        <CalendarIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                        <p v-html="dateToPresent(row.from, row.to)"></p>
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

<PromptModal title="Remove this Number?" confirmButtonName="Remove" @confirm="$exp.DestroyAPI()" v-model="showPrompt">
  <p class="text-gray-500">Are you sure you want to remove this number? This action cannot be undone.</p>
</PromptModal>
</template>

<script setup lang="ts">
import { onMounted, ref, watch } from 'vue'
import * as Yup from 'yup'
import { useExperienceStore } from '@/store/@applicant/ExperienceStore'
import { useWorkStatusStore } from '@/store/system/WorkStatusStore'
import { useSalaryTypeStore } from '@/store/system/SalaryTypeStore'
import { CalendarIcon, BanknotesIcon, MapPinIcon, StopIcon, TagIcon } from '@heroicons/vue/24/outline'
import moment from 'moment'
import { NumberAddComma } from '@/helpers/Converter'
import { useDebounceFn } from '@vueuse/core'

import Layout from     './~Components/Layout.vue'
import ContentCard from'./~Components/ContentCard.vue'
import FormCard from   './~Components/FormCard.vue'
import AppInput from    '@/components/form/AppInput.vue'
import PromptModal from '@/components/modals/PromptModal.vue'
import AppButton from   '@/components/form/AppButton.vue'
import BasicTransition from '@/components/transitions/BasicTransition.vue'
import DataTransition from  '@/components/transitions/DataTransition.vue'
import AppSelect from   '@/components/form/AppSelect.vue'

const schema = Yup.object({
  position: Yup.string().required('Position is required'),
  company: Yup.string().required('Company is required'),
  work_status: Yup.number().required('Work Status is required'),
  from: Yup.date().typeError('Invalid Date').required('From date is Required'),
  // to: Yup.date().typeError('Invalid Date').required('To date is Required'),
  salary: Yup.number().required('Salary is required').typeError('Invalid Number'),
  salary_type: Yup.number().required('Salary is required').typeError('Invalid Number'),
})
const schema_update = schema
const $exp = useExperienceStore()
const $exp_status = useWorkStatusStore()
const $salaryType = useSalaryTypeStore()
const showPrompt = ref(false)

function dateToPresent(from: Date, to: Date) {
  if(to) {
    return `${moment(from).format('MMM DD, YYYY')} - ${moment(to).format('MMM DD, YYYY')} (${moment(to).diff(from, "years") + 1} yrs)`
  }
  return `${moment(from).format('MMM DD, YYYY')} - <span class='text-primary-700'>PRESENT<span> (${(moment(from).diff(moment(), "years") + 1) * -1} yrs)`
}

onMounted(() => {
  $exp.GetAPI()
})

watch($exp.query, useDebounceFn(() => {
  $exp.GetAPI()
}, 600))
</script>
