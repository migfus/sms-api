<template>
  <div>
    <Layout>
      <div class="divide-y divide-gray-200 lg:col-span-9">

        <!-- SECTION FORMS -->
        <BasicTransition>
          <!-- NOTE ADD -->
          <FormCard
            v-if="$files.config.form == 'create'"
            v-slot="{errors}"
            title="Create Mobile Number"
            :loading="$files.config.buttonLoading"
            :formSchema="schema"
            submitButtonName="Create"
            @submitForm="$files.PostAPI()"
            @cancelClick="$files.ChangeForm(null)"
          >
            <div class="col-span-12">
                <AppInput v-model="$files.params.filename" placeholder="New Number" name="number" type="number" :errors="errors"/>
            </div>
          </FormCard>

        </BasicTransition>

        <!-- SECTION CONTENT -->
        <ContenCard
          v-model="$files.query.search"
          title="Uploaded Documents"
          :form="$files.config.form"
          :buttonLoading="$files.config.buttonLoading"
          :contentLoading="$files.config.contentLoading"
          @actionCreateClick="$files.ChangeForm(null, 'create')"
          @actionCancelClick="$files.ChangeForm(null)"
        >
          <template #search>
            <AppInput v-model="$files.query.search" name="search" placeholder="Search" noLabel/>
          </template>
          <template #default>
            <DataTransition>
              <li v-for="row in $files.content" :key="row.id">
                <div class="block hover:bg-gray-50">
                  <div class="px-4 py-4 sm:px-6">
                    <div class="flex items-center justify-between">
                      <p class="truncate font-medium text-primary-600">{{ row.filename }}</p>
                      <div class="ml-2 flex flex-shrink-0">
                        <AppButton @click="showPrompt = true; $files.SetIDToDelete(row.id)" color='danger' size="sm" :loading="$files.config.buttonLoading">Remove</AppButton>
                      </div>
                    </div>
                    <div class="mt-2 sm:flex sm:justify-between">
                      <div class="sm:flex gap-2 mr-2">
                        <a :href="row.url" target="_blank" class="flex items-center text-sm text-gray-500 mb-2 sm:mb-0 truncate">
                          <ClipboardIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                          {{ row.url }}
                        </a>
                      </div>
                      <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0 sm:mb-0">
                        <CalendarIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                        <p>{{ `${moment(row.created_at).format('MMM DD, YYYY hh:mm A')}`}}</p>
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

  <PromptModal title="Remove this Number?" confirmButtonName="Remove" @confirm="$files.DestroyAPI()" v-model="showPrompt">
    <p class="text-gray-500">Are you sure you want to remove this number? This action cannot be undone.</p>
  </PromptModal>
</template>

<script setup lang="ts">
import { onMounted, ref, watch } from 'vue'
import * as Yup from 'yup'
import { useFilesStore } from '@/store/@applicant/FilesStore'
import { mobileToFormatted } from '@/helpers/Converter'
import { useDebounceFn } from '@vueuse/core'
import moment from 'moment'
import { CalendarIcon, ClipboardIcon } from '@heroicons/vue/24/outline'

import Layout from     './~Components/Layout.vue'
import ContenCard from './~Components/ContentCard.vue'
import FormCard from   './~Components/FormCard.vue'
import AppInput from    '@/components/form/AppInput.vue'
import PromptModal from '@/components/modals/PromptModal.vue'
import AppButton from   '@/components/form/AppButton.vue'
import BasicTransition from '@/components/transitions/BasicTransition.vue'
import DataTransition  from '@/components/transitions/DataTransition.vue'

const schema = Yup.object({
    number: Yup.string().required('Number is required').min(10, 'At least 10 characters').max(11, 'Exceeded 10 characters'),
})
const schema_update = Yup.object({
    number: Yup.string().required('Number is required').min(10, 'At least 10 characters').max(11, 'Exceeded 10 characters'),
})

const $files = useFilesStore()
const showPrompt = ref(false)

onMounted(() => {
  $files.GetAPI()
})
watch($files.query, useDebounceFn(() => {
  $files.GetAPI()
}, 600))
</script>
