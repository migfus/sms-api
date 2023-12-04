<template>
  <div>
    <Layout>
      <div class="divide-y divide-gray-200 lg:col-span-9">

        <!-- SECTION FORMS -->
        <BasicTransition>
          <!-- NOTE ADD -->
          <FormCard
            v-if="$educ.config.form == 'create'"
            v-slot="{errors}"
            title="Create Education"
            :loading="$educ.config.buttonLoading"
            :formSchema="schema"
            submitButtonName="Create"
            @submitForm="$educ.PostAPI()"
            @cancelClick="$educ.ChangeForm(null)"
          >
            <div class="col-span-6 sm:col-span-6">
              <AppSelect v-model="$educ.params.level" placeholder="Education Level" name="level" :errors="errors">
                <option v-for="row in $levels.content" :key="row.id" :value="row.id">{{ row.name }}</option>
              </AppSelect>
            </div>

            <div class="col-span-6">
                <AppInput v-model="$educ.params.school" placeholder="School Name" name="school" :errors="errors"/>
            </div>

            <div class="col-span-4">
              <AppInput v-model="$educ.params.from" placeholder="From" name="from" type="date" :errors="errors"/>
            </div>
            <div class="col-span-4">
              <AppInput v-model="$educ.params.to" placeholder="To (Empty if ongoing)" name="to" type="date" :errors="errors"/>
            </div>
            <div class="col-span-4">
              <AppInput v-model="$educ.params.scholarship" placeholder="Scholarship" name="scholarship" :errors="errors"/>
            </div>

            <div
              v-if="$educ.params.level == 549717181133505 || $educ.params.level == 549717181143755  || $educ.params.level == 549717181150779 || $educ.params.level == 549717181124844"
              class="col-span-6"
            >
              <AppInput v-model="$educ.params.degree" :placeholder="$educ.params.level == 549717181124844 ? 'Vocation' : 'Degree'" name="degree" :errors="errors"/>
            </div>
            <div v-if="$educ.params.level != 549717181124844" class="col-span-6">
              <AppInput v-model="$educ.params.honors" placeholder="Honors" name="honors" :errors="errors"/>
            </div>

          </FormCard>
          <!-- NOTE UPDATE -->
          <FormCard
            v-if="$educ.config.form == 'update'"
            v-slot="{errors}"
            title="Update Mobile Number"
            :loading="$educ.config.buttonLoading"
            :formSchema="schema_update"
            submitButtonName="Update"
            @submitForm="$educ.UpdateAPI()"
            @cancelClick="$educ.ChangeForm(null)"
          >
            <div class="col-span-6 sm:col-span-6">
              <AppSelect v-model="$educ.params.level" placeholder="Education Level" name="level" :errors="errors">
                <option v-for="row in $levels.content" :key="row.id" :value="row.id">{{ row.name }}</option>
              </AppSelect>
            </div>

            <div class="col-span-6">
                <AppInput v-model="$educ.params.school" placeholder="School Name" name="school" :errors="errors"/>
            </div>

            <div class="col-span-4">
              <AppInput v-model="$educ.params.from" placeholder="From" name="from" type="date" :errors="errors"/>
            </div>
            <div class="col-span-4">
              <AppInput v-model="$educ.params.to" placeholder="To (Empty if ongoing)" name="to" type="date" :errors="errors"/>
            </div>
            <div class="col-span-4">
              <AppInput v-model="$educ.params.scholarship" placeholder="Scholarship" name="scholarship" :errors="errors"/>
            </div>

            <div
              v-if="$educ.params.level == 549717181133505 || $educ.params.level == 549717181143755  || $educ.params.level == 549717181150779 || $educ.params.level == 549717181124844"
              class="col-span-6"
            >
              <AppInput v-model="$educ.params.degree" :placeholder="$educ.params.level == 549717181124844 ? 'Vocation' : 'Degree'" name="degree" :errors="errors"/>
            </div>
            <div v-if="$educ.params.level != 549717181124844" class="col-span-6">
              <AppInput v-model="$educ.params.honors" placeholder="Honors" name="honors" :errors="errors"/>
            </div>
          </FormCard>
        </BasicTransition>

        <!-- SECTION CONTENT -->
        <ContenCard
          v-model="$educ.query.search"
          title="Education Attainment"
          :form="$educ.config.form"
          :buttonLoading="$educ.config.buttonLoading"
          :contentLoading="$educ.config.contentLoading"
          @actionCreateClick="$educ.ChangeForm(null, 'create')"
          @actionCancelClick="$educ.ChangeForm(null)"
        >
          <template #search>
            <AppInput v-model="$educ.query.search" name="search" placeholder="Search" noLabel/>
          </template>
          <template #default>
            <DataTransition>
              <li v-for="row in $educ.content" :key="row.id">
                <div class="block hover:bg-gray-50">
                  <div class="px-4 py-4 sm:px-6">
                    <div class="flex items-center justify-between">
                      <p :class="['truncate text-sm font-medium text-primary-600', EducationLevel(row.education_levels.name)]">
                        {{ row.education_levels.name }} - {{ row.school }}
                      </p>
                      <div class="ml-2 flex flex-shrink-0">
                        <AppButton @click="$educ.ChangeForm(row, 'update')" color='white' class="mr-2" size="sm">Edit</AppButton>
                        <AppButton @click="showPrompt = true; $educ.SetIDToDelete(row.id)" color='danger' size="sm">Remove</AppButton>
                      </div>
                    </div>
                    <div class="mt-2 sm:flex sm:justify-between">
                      <div class="sm:flex gap-2">
                        <p v-if="row.degree" class="flex items-center text-sm text-gray-500 mb-2 sm:mb-0">
                          <AcademicCapIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                          {{ row.degree }}
                        </p>
                        <p v-if="row.honors" class="flex items-center text-sm text-gray-500 mb-2 sm:mb-0">
                          <StarIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                          {{ row.honors }}
                        </p>
                        <p v-if="row.scholarship" class="flex items-center text-sm text-gray-500 mb-2 sm:mb-0">
                          <CheckBadgeIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                          {{ row.scholarship }}
                        </p>
                      </div>
                      <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0 sm:mb-0">
                        <CalendarIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                        <p v-html="DateDisplay(row.from, row.to)"></p>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
            </DataTransition>
          </template>
        </ContenCard>

      </div>
    </Layout>
  </div>

  <PromptModal title="Remove this Number?" confirmButtonName="Remove" @confirm="$educ.DestroyAPI()" v-model="showPrompt">
    <p class="text-gray-500">Are you sure you want to remove this number? This action cannot be undone.</p>
  </PromptModal>
</template>

<script setup lang="ts">
import { onMounted, ref, watch } from 'vue'
import * as Yup from 'yup'
import { useEducationStore } from '@/store/@applicant/EducationStore'
import { useEducationLevelStore } from '@/store/system/EducationLevelStore'
import { useDebounceFn } from '@vueuse/core'
import moment from 'moment'
import { CalendarIcon, CheckBadgeIcon, StarIcon, AcademicCapIcon } from '@heroicons/vue/24/outline'

import Layout from     './~Components/Layout.vue'
import ContenCard from './~Components/ContentCard.vue'
import FormCard from   './~Components/FormCard.vue'
import AppInput from    '@/components/form/AppInput.vue'
import PromptModal from '@/components/modals/PromptModal.vue'
import AppButton from   '@/components/form/AppButton.vue'
import BasicTransition from '@/components/transitions/BasicTransition.vue'
import DataTransition  from '@/components/transitions/DataTransition.vue'
import AppSelect from '@/components/form/AppSelect.vue'

const schema = Yup.object({
  level: Yup.string().required('Education level is required'),
  school: Yup.string().required('School name is required'),
  from: Yup.date().required('From Date is required').typeError('Invalid Date'),
})
const schema_update = schema

const $educ = useEducationStore()
const $levels = useEducationLevelStore()
const showPrompt = ref(false)

function EducationLevel(level: string) {
  if(level == 'College' || level == 'Masteral' || level == 'Doctoral') {
    return 'text-orange-500'
  }
  return ''
}
function DateDisplay(from: Date, to: Date) {
  if(to) {
    return `${moment(from).format('MMM DD, YYYY')} - ${moment(to).format('MMM DD, YYYY')}`
  }
  return `${moment(from).format('MMM DD, YYYY')} - <span class="text-yellow-600 font-bold">On Going</span>`
}

onMounted(() => {
  $educ.GetAPI()
})
watch($educ.query, useDebounceFn(() => {
  $educ.GetAPI()
}, 600))
</script>
