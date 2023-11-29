<template>
  <div>
    <BasicTransition>
      <main v-if="$mobiles.config.form == 'create'" class="relative">
        <div class="mx-auto max-w-screen-xl pb-6">
          <div class="overflow-hidden rounded-xl bg-white shadow">
              <Form v-slot="{ errors }" :validation-schema="schema" @submit="$mobiles.PostAPI()" class="rounded-xl divide-y divide-gray-200 lg:col-span-9">
                <div class="py-6 px-4 sm:p-6 lg:pb-8">
                  <div>
                    <h2 class="text-lg font-medium leading-6 text-gray-900">Create Mobile Number</h2>
                  </div>
                  <div class="mt-6 flex flex-col lg:flex-row">
                    <div class="flex-grow space-y-6">
                      <div class="col-span-6">
                          <AppInput v-model="$mobiles.params.number" placeholder="New Number" name="number" type="number" :errors="errors"/>
                      </div>

                      <div class="flex justify-end mt-8 gap-1">
                        <AppButton type="submit" color='white' :disabled="Object.keys(errors).length != 0">Create</AppButton>
                        <AppButton @click="$mobiles.ChangeForm(null)" color='white'>Cancel</AppButton>
                      </div>
                    </div>
                  </div>

                </div>

              </Form>
          </div>
        </div>
      </main>

      <main v-if="$mobiles.config.form == 'update'" class="relative">
        <div class="mx-auto max-w-screen-xl pb-6">
          <div class="overflow-hidden rounded-xl bg-white shadow">
              <Form v-slot="{ errors }" :validation-schema="schema_update" @submit="$mobiles.UpdateAPI()" class="rounded-xl divide-y divide-gray-200 lg:col-span-9">
                <div class="py-6 px-4 sm:p-6 lg:pb-8">
                  <div>
                    <h2 class="text-lg font-medium leading-6 text-gray-900">Update Mobile Number</h2>
                  </div>
                  <div class="mt-6 flex flex-col lg:flex-row">
                    <div class="flex-grow space-y-6">
                      <div class="col-span-6">
                          <AppInput v-model="$mobiles.params.number" placeholder="Number" name="number" type="number" :errors="errors"/>
                      </div>

                      <div class="flex justify-end mt-8 gap-1">
                        <AppButton type="submit" color='white' :disabled="Object.keys(errors).length != 0">Update</AppButton>
                        <AppButton @click="$mobiles.ChangeForm(null)" color='white'>Cancel</AppButton>
                      </div>
                    </div>
                  </div>

                </div>

              </Form>
          </div>
        </div>
      </main>
    </BasicTransition>



    <Layout>
      <Loader v-if="$mobiles.config.loading" />
      <div v-else class="divide-y divide-gray-200 lg:col-span-9">
        <!-- Profile section -->
        <div class="py-6 px-4 sm:p-6 lg:pb-8">
          <div>
            <h2 class="text-lg font-medium leading-6 text-gray-900">Mobile Numbers</h2>
          </div>

          <div class="bg-white lg:min-w-0 lg:flex-1">

            <ul role="list" class="divide-y divide-gray-200 border-b border-gray-200">
              <li v-for="row in $mobiles.content" :key="row.id" class="relative py-2 pl-4 pr-6 hover:bg-gray-50 sm:py-3 sm:pl-6 lg:pl-8 xl:pl-6">
                <div class="flex items-center justify-between space-x-4">
                  <!-- Repo name and link -->
                  <div class="min-w-0 space-y-3">
                    <a  class="group relative flex items-center space-x-2.5">
                      <span :class="['bg-green-100', 'bg-gray-100', 'h-4 w-4 rounded-full flex items-center justify-center']" aria-hidden="true">
                        <span :class="['bg-green-400', 'bg-gray-400', 'h-2 w-2 rounded-full']" />
                      </span>
                      <h3 class="truncate font-bold text-gray-500 group-hover:text-gray-900">{{ mobileToFormatted(row.number) }}</h3>
                    </a>
                  </div>
                  <!-- Repo meta info -->
                  <div class="flex-shrink-0 flex-col items-end space-y-3 sm:flex">
                    <p class="flex space-x-2 text-sm text-gray-500">
                      <span><AppButton @click="$mobiles.ChangeForm(row, 'update')" size="sm" color="white">Edit</AppButton></span>
                      <span><AppButton @click="showPrompt = true; $mobiles.SetIDToDelete(row.id)" size="sm" color="white">Remove</AppButton></span>
                    </p>
                  </div>
                </div>
              </li>
            </ul>
          </div>




          <div class="flex justify-end mt-8 gap-1">
            <AppButton v-if="$mobiles.config.form == null" @click="$mobiles.ChangeForm(null, 'create')" color='white'>Create</AppButton>
            <AppButton v-else @click="$mobiles.ChangeForm(null)" color='white'>Cancel</AppButton>
          </div>
        </div>
      </div>


  </Layout>
</div>

<PromptModal title="Remove this Number?" confirmButtonName="Remove" @confirm="$mobiles.DestroyAPI()" v-model="showPrompt">
  <p class="text-gray-500">Are you sure you want to remove this number? This action cannot be undone.</p>
</PromptModal>
</template>

<script setup lang="ts">
import { onMounted, ref } from 'vue'
import * as Yup from 'yup'
import { Form, configure } from 'vee-validate'
import { useMobileNumberStore } from '@/store/@applicant/MobileNumberStore'
import { mobileToFormatted } from '@/helpers/Converter'

import AppInput from '@/components/form/AppInput.vue'
import PromptModal from '@/components/modals/PromptModal.vue'
import Layout from './Layout.vue'
import AppButton from '@/components/form/AppButton.vue'
import Loader from './Loader.vue'
import BasicTransition from '@/components/transitions/BasicTransition.vue'

configure({
    validateOnInput: true
})

const schema = Yup.object({
    number: Yup.string().required('Number is required').min(10, 'At least 10 characters').max(11, 'Exceeded 10 characters'),
})
const schema_update = Yup.object({
    number: Yup.string().required('Number is required').min(10, 'At least 10 characters').max(11, 'Exceeded 10 characters'),
})

const $mobiles = useMobileNumberStore()
const showPrompt = ref(false)

onMounted(() => {
  $mobiles.GetAPI()
})
</script>
