<template>
  <div>
    <Layout>
      <div class="divide-y divide-gray-200 lg:col-span-9">

        <!-- SECTION FORMS -->
        <BasicTransition>
          <!-- NOTE ADD -->
          <form
            v-if="$files.config.form == 'create'"
            enctype="multipart/form-data"
            class="sm:rounded-xl divide-y divide-gray-200 lg:col-span-9 bg-white shadow mb-3 grid-cols-12"
          >
            <div class="py-6 px-4 sm:p-6 lg:pb-8 ">
              <div>
                <h2 class="text-lg font-medium leading-6 text-gray-900">Upload File</h2>
              </div>
              <div class="mt-6">
                <div class="grid grid-cols-1">
                  <div class="sm:grid sm:grid-cols-1 sm:items-start sm:pt-5">
                    <div class="mt-1 sm:col-span-2 sm:mt-0">
                      <div class="flex max-w-full justify-center rounded-md border-2 border-dashed border-gray-300 px-6 pt-5 pb-6">
                        <div class="space-y-1 text-center">
                          <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                          </svg>
                          <div class="flex text-sm text-gray-600">
                            <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-medium text-primary-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-primary-500 focus-within:ring-offset-2 hover:text-primary-500">
                              <span>Upload a file</span>
                              <input
                                @change="$files.PostAPI($event)"
                                accept=".doc, .docx, .pdf, .xlsx, .jpg, .png, .jpeg, .gif"
                                id="file-upload"
                                name="file-upload"
                                type="file"
                                class="sr-only"
                              />
                            </label>
                            <p class="pl-1">or drag and drop</p>
                          </div>
                          <p class="text-xs text-gray-500"><span class="text-primary-600">IMAGES</span> & <span class="text-yellow-600">DOCUMENTS</span> up to 10MB</p>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="flex justify-end mt-3 gap-1 col-span-12">
                    <AppButton @click="$files.ChangeForm(null)" color='danger' :loading="$files.config.buttonLoading">Cancel</AppButton>
                  </div>
                </div>
              </div>

            </div>

          </form>

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

              <ul role="list" class="grid grid-cols-2 gap-x-4 gap-y-8 sm:grid-cols-3 sm:gap-x-6 lg:grid-cols-4 xl:gap-x-8 px-5 py-6">
                <li  v-for="row in $files.content" :key="row.id" class="relative justify-content-end">

                  <div class="aspect-w-10 aspect-h-7 block w-full h-44 overflow-hidden sm:rounded-xl bg-gray-100 focus-within:ring-2 focus-within:ring-primary-500 focus-within:ring-offset-2 focus-within:ring-offset-gray-100">

                    <iframe
                      v-if="FileExtension(row.filename) == 'docx' || FileExtension(row.filename) == 'doc' || FileExtension(row.filename) == 'xlsx' || FileExtension(row.filename) == 'pdf'"
                      :src="'https://docs.google.com/gview?url=' + row.url + '&embedded=true'"
                    ></iframe>


                    <img v-else
                      :src="FileExtensionPreview(row.filename, row.url)"
                      alt=""
                      class="pointer-events-none group-hover:opacity-75 object-fill"
                    />


                    <p class="text-sm font-medium text-gray-500 absolute mt-1 ml-2 flex justify-end gap-1 top-2 right-2">
                      <a :href="row.url" target="_blank">
                        <AppButton size="sm" color="white" type="button">
                          <ArrowDownCircleIcon class="h-4 w-4 flex-shrink-0 text-gray-500" aria-hidden="true" />
                        </AppButton>
                      </a>
                      <AppButton @click="$files.SetIDToDelete(row.id); showPrompt = true" size="sm" color="danger" type="button">
                        <XMarkIcon class="h-4 w-4 flex-shrink-0 text-gray-500" aria-hidden="true" />
                      </AppButton>
                    </p>


                  </div>

                  <div class="flex justify-between mt-1">
                    <p class="pointer-events-none block truncate text-sm font-medium text-gray-900">{{ FileExtension(row.filename, true) }}</p>
                    <p class="pointer-events-none block text-sm font-medium text-gray-900">.{{ FileExtension(row.filename) }}</p>


                  </div>
                  <div class="sm:flex sm:justify-between">
                    <p class="pointer-events-none block truncate text-sm font-medium text-gray-500">{{ formatBytes(row.size) }}</p>
                  </div>
                </li>
              </ul>


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
import { useFilesStore } from '@/store/@applicant/FilesStore'
import { useDebounceFn } from '@vueuse/core'
import { ArrowDownCircleIcon, XMarkIcon } from '@heroicons/vue/24/outline'
import { formatBytes, FileExtensionPreview, FileExtension } from '@/helpers/Converter'

import Layout from     './~Components/Layout.vue'
import ContenCard from './~Components/ContentCard.vue'
import AppInput from    '@/components/form/AppInput.vue'
import PromptModal from '@/components/modals/PromptModal.vue'
import AppButton from   '@/components/form/AppButton.vue'
import BasicTransition from '@/components/transitions/BasicTransition.vue'
import DataTransition  from '@/components/transitions/DataTransition.vue'

const $files = useFilesStore()
const showPrompt = ref(false)

onMounted(() => {
  $files.GetAPI()
})
watch($files.query, useDebounceFn(() => {
  $files.GetAPI()
}, 600))
</script>
