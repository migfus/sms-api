<template>
  <div>
    <BasicTransition>
      <main v-if="$mobiles.config.form == 'create'" class="relative">
        <div class="mx-auto max-w-screen-xl pb-3">
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
        <div class="mx-auto max-w-screen-xl pb-3">
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

        <h2 class="bg-white mb-3 rounded-xl p-5 shadow font-bold text-gray-600">Mobile Numbers</h2>

        <div class="px-4 sm:p-0 lg:pb-8">

          <div class="overflow-hidden bg-white shadow sm:rounded-xl mb-3">
            <ul role="list" class="divide-y divide-gray-200">
              <li v-for="row in $mobiles.content" :key="row.id">
                <div class="block hover:bg-gray-50">
                  <div class="px-4 py-4 sm:px-6">
                    <div class="flex items-center justify-between">
                      <p class="truncate text-md font-medium text-primary-600">{{ mobileToFormatted(row.number) }}</p>
                      <div class="ml-2 flex flex-shrink-0">
                        <AppButton @click="$mobiles.ChangeForm(row, 'update')" color='white' class="mr-2">Edit</AppButton>
                        <AppButton @click="showPrompt = true; $mobiles.SetIDToDelete(row.id)" color='white'>Remove</AppButton>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
            </ul>
          </div>

          <ActionCard :form="$mobiles.config.form" @createClick="$mobiles.ChangeForm(null, 'create')" @cancelClick="$mobiles.ChangeForm(null)"/>

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
import ActionCard from './ActionCard.vue'

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
