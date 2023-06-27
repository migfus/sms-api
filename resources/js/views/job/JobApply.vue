<template>
  <div>
    <div v-if="status == 2" class="grid grid-cols-3 gap-4 mb-4 mt-4">

      <div class="grid grid-cols-1 gap-4 col-span-3 lg:col-span-2">
        <ActivityCard />
      </div>

      <div class="grid grid-cols-1 gap-4 col-span-3 lg:col-span-1">
        <section aria-labelledby="section-1-title">
          <h2 class="sr-only" id="section-1-title">Section title</h2>
          <div class="flex justify-end overflow-hidden rounded-lg bg-white shadow">
            <div class="px-6 py-4 text-end">
              <span class="isolate inline-flex rounded-md shadow-sm mt-1">
                <button @click="CancelProcessed()" type="button" class="mr-2 relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 focus:z-10 focus:border-red-500 focus:outline-none focus:ring-1 focus:ring-red-500">
                  <XMarkIcon class="-ml-1 mr-2 h-5 w-5 text-gray-400" aria-hidden="true" />
                  Cancel
                </button>
                <button type="button" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 focus:z-10 ">
                  <CheckCircleIcon class="-ml-1 mr-2 h-5 w-5 text-primary-600" aria-hidden="true" />
                  Applied
                </button>
              </span>
            </div>
          </div>
        </section>
      </div>


    </div>

    <div v-else-if="status == 1">
      <div class="bg-white px-4 py-4 shadow sm:rounded-lg sm:p-6 mt-4">
        <div class="md:grid md:grid-cols-3 md:gap-6">
          <div class="md:col-span-1">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Apply</h3>
            <p class="mt-1 text-sm text-gray-500">This information will be submitted to HRMO staff & they will notify for any updates.</p>
          </div>
          <div class="mt-5 space-y-6 md:col-span-2 md:mt-0">
            <div class="grid grid-cols-1 gap-6">
              <div class="col-span-3 sm:col-span-2">
                <label for="company-website" class="block text-sm font-medium text-gray-700">Subject</label>
                <div class="mt-1 flex rounded-md shadow-sm">
                  <input v-model="form.subject" type="text" name="company-website" id="company-website" class="block w-full flex-1 rounded-md border-gray-300 focus:border-primary-500 focus:ring-primary-500 sm:text-sm" placeholder="Title" />
                </div>
              </div>
            </div>

            <div>
              <label for="about" class="block text-sm font-medium text-gray-700">Message</label>
              <div class="mt-1">
                <textarea v-model="form.message" id="about" name="about" rows="3" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm" placeholder="Message..." />
              </div>
            </div>

            <div>
              <label for="about" class="block text-sm font-medium text-gray-700">Any Contact Info</label>
              <div class="mt-1">
                <textarea v-model="form.contact" id="about" name="about" rows="3" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm" placeholder="email, phone number, etc." />
              </div>
            </div>

            <div>

              <span v-for="(row, idx,) in form.attachements" :key="row.id" class="isolate inline-flex rounded-md shadow-sm mr-2 mb-2">
                <button type="button" class="w-48 relative inline-flex items-center rounded-l-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:z-10 focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500">
                  <div class="truncate">{{ row.name.split('.').slice(0, -1).join('.') }}</div>
                  .{{ row.name.split('.').pop() }}
                </button>
                <button @click="RemoveRow(idx)" type="button" class="relative -ml-px inline-flex items-center rounded-r-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:z-10 focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500">
                  <XMarkIcon class="h-5 w-5 text-gray-600" aria-hidden="true" />
                </button>
              </span>

              <label class="block text-sm font-medium text-gray-700">Document Attachement</label>
              <div class="mt-1 flex justify-center rounded-md border-2 border-dashed border-gray-300 px-6 pt-5 pb-6">
                <div class="space-y-1 text-center">
                  <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                  <div class="flex text-sm text-gray-600">
                    <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-medium text-primary-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-primary-500 focus-within:ring-offset-2 hover:text-primary-500">
                      <span>Upload a file</span>
                      <input @change="AttachFiles" accept=".xls, .xlsx, .pdf, .doc, .docx, .jpg, .png" id="file-upload" name="file-upload" type="file" class="sr-only" multiple />
                    </label>
                    <p class="pl-1">or drag and drop</p>
                  </div>
                  <p class="text-xs text-gray-500">Images, Documents, Excels up to 50MB</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="flex justify-end overflow-hidden rounded-lg bg-white">
          <div class="pt-4 text-end">
            <span class="isolate inline-flex rounded-md shadow-sm mt-1">
              <button @click="Cancel()" type="button" class="mr-2 relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 focus:z-10 focus:border-red-500 focus:outline-none focus:ring-1 focus:ring-red-500">
                <XMarkIcon class="-ml-1 mr-2 h-5 w-5 text-gray-400" aria-hidden="true" />
                Cancel
              </button>
              <button @click="Submit()" type="button" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 focus:z-10 focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500">
                <PaperAirplaneIcon class="-ml-1 mr-2 h-5 w-5 text-gray-400" aria-hidden="true" />
                Submit
              </button>
            </span>
          </div>
        </div>
      </div>
    </div>

    <div v-else class="grid grid-cols-1 gap-4 mb-4 mt-4">
      <div class="grid grid-cols-1 gap-4 col-span-3">
        <section aria-labelledby="section-1-title">
          <h2 class="sr-only" id="section-1-title">Section title</h2>
          <div class="flex justify-end overflow-hidden rounded-lg bg-white shadow">
            <div class="px-6 py-4 text-end">
              <span class="isolate inline-flex rounded-md shadow-sm mt-1">
                <button @click="Apply()" type="button" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 focus:z-10 focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500">
                  <ArrowRightCircleIcon class="-ml-1 mr-2 h-5 w-5 text-gray-400" aria-hidden="true" />
                  Apply Now
                </button>
              </span>
            </div>
          </div>
        </section>
      </div>
    </div>

  </div>
  <CancelProcessedPrompt :open="openPrompt"/>
</template>

<script setup>
import { ArrowRightCircleIcon, XMarkIcon, PaperAirplaneIcon, CheckCircleIcon } from '@heroicons/vue/20/solid';
import { ref, reactive} from 'vue'

import ActivityCard from './ActivityCard.vue'
import CancelProcessedPrompt from './CancelProcessedPrompt.vue';

const status = ref(0); // [0] = not applied, [1] = fill-up,, [2] = applied
const openPrompt = ref(false);
const form = reactive({
  subject: '',
  message: '',
  contact: '',
  attachements: null,
});

function AttachFiles(event) {
  form.attachements = Array.from(event.target.files)
  console.log(form)
}

function RemoveRow(idx) {
  console.log(form.attachements)
  form.attachements.splice(idx, 1)
}

function Cancel() {
  Object.assign(form, {
    subject: '',
    message: '',
    contact: '',
    attachements: null,
  })
  status.value = 0

  window.scroll({
    top: 0,
    left: 0,
    behavior: 'smooth'
  })
}

function Apply() {
  status.value = 1
  window.scroll({
    top: document.body.scrollHeight,
    left: 0,
    behavior: 'smooth'
  })
}

function Submit() {
  status.value = 2
  window.scroll({
    top: 0,
    left: 0,
    behavior: 'smooth'
  })
}

function CancelProcessed() {
  openPrompt.value = true
}

console.log('test')
</script>
