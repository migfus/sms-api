<template>
  <div>
    <BasicTransition>
      <main v-if="$skills.config.form == 'create'" class="relative">
        <div class="mx-auto max-w-screen-xl pb-3">
          <div class="overflow-hidden rounded-xl bg-white shadow">
              <Form v-slot="{ errors }" :validation-schema="schema" @submit="$skills.PostAPI()" class="rounded-xl divide-y divide-gray-200 lg:col-span-9">
                <div class="py-6 px-4 sm:p-6 lg:pb-8">
                  <div>
                    <h2 class="text-lg font-medium leading-6 text-gray-900">Add Skill</h2>
                  </div>
                  <div class="mt-6 grid grid-cols-2 lg:flex-row gap-2">

                      <div>
                          <AppInput v-model="$skills.params.name" placeholder="Skill" name="skill" :errors="errors"/>
                      </div>
                      <div>
                          <AppInput v-model="$skills.params.recognition" placeholder="Recognition" name="recognition" :errors="errors"/>
                      </div>

                      <div class="flex justify-end mt-8 gap-1 col-span-2">
                        <AppButton color='white' type="submit" :disabled="Object.keys(errors).length != 0">Create</AppButton>
                        <AppButton @click="$skills.ChangeForm(null)" color='white'>Cancel</AppButton>
                      </div>

                  </div>
                </div>
              </Form>
          </div>
        </div>
      </main>

      <main v-if="$skills.config.form == 'update'" class="relative">
        <div class="mx-auto max-w-screen-xl pb-3">
          <div class="overflow-hidden rounded-xl bg-white shadow">
            <Form v-slot="{ errors }" :validation-schema="schema_update" @submit="$skills.UpdateAPI()" class="rounded-xl divide-y divide-gray-200 lg:col-span-9">
              <div class="py-6 px-4 sm:p-6 lg:pb-8">
                <div>
                  <h2 class="text-lg font-medium leading-6 text-gray-900">Update Skill</h2>
                </div>
                <div class="mt-6 grid grid-cols-2 gap-2">

                    <div>
                        <AppInput v-model="$skills.params.name" placeholder="Skill" name="skill" :errors="errors"/>
                    </div>
                    <div>
                        <AppInput v-model="$skills.params.recognition" placeholder="Recognition" name="recognition" :errors="errors"/>
                    </div>


                    <div class="flex justify-end mt-3 gap-1 col-span-2">
                      <AppButton type="submit" color='white' :disabled="Object.keys(errors).length != 0">Update</AppButton>
                      <AppButton @click="$skills.ChangeForm(null)" color='white'>Cancel</AppButton>
                    </div>

                </div>
              </div>
            </Form>
          </div>
        </div>
      </main>
    </BasicTransition>



    <Layout>
      <Loader v-if="$skills.config.loading" />

      <div v-else class="divide-y divide-gray-200 lg:col-span-9">

        <h2 class="bg-white mb-3 rounded-xl p-5 shadow font-bold text-gray-600">Skills</h2>

        <div class="px-4 sm:p-0 lg:pb-8">

          <div class="overflow-hidden bg-white shadow sm:rounded-xl mb-3">
            <ul role="list" class="divide-y divide-gray-200">

              <li v-for="row in $skills.content" :key="row.id">
                <div class="block hover:bg-gray-50">
                  <div class="px-4 py-4 sm:px-6">
                    <div class="flex items-center justify-between">
                      <p class="truncate text-sm font-medium text-primary-600">{{ row.name }}</p>
                      <div class="ml-2 flex flex-shrink-0">
                        <AppButton @click="$skills.ChangeForm(row, 'update')" color='white' class="mr-2">Edit</AppButton>
                        <AppButton @click="showPrompt = true; $skills.SetIDToDelete(row.id)" color='white'>Remove</AppButton>

                      </div>
                    </div>
                    <div class="mt-2 sm:flex sm:justify-between">
                      <div class="sm:flex">
                        <p class="flex items-center text-sm text-gray-500">
                          <CheckBadgeIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                          {{ row.recognition }}
                        </p>
                      </div>

                    </div>
                  </div>
                </div>
              </li>
            </ul>
          </div>

          <ActionCard :form="$skills.config.form" @createClick="$skills.ChangeForm(null, 'create')" @cancelClick="$skills.ChangeForm(null)"/>
        </div>
      </div>






  </Layout>
</div>

<PromptModal title="Remove this Number?" confirmButtonName="Remove" @confirm="$skills.DestroyAPI()" v-model="showPrompt">
  <p class="text-gray-500">Are you sure you want to remove this number? This action cannot be undone.</p>
</PromptModal>
</template>

<script setup lang="ts">
import { onMounted, ref } from 'vue'
import * as Yup from 'yup'
import { Form, configure } from 'vee-validate'
import { useSkillStore } from '@/store/@applicant/SkillStore'
import { CheckBadgeIcon } from '@heroicons/vue/24/outline'

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
    skill: Yup.string().required('Skill is required'),
})
const schema_update = Yup.object({
  skill: Yup.string().required('Skill is required'),
})

const $skills = useSkillStore()
const showPrompt = ref(false)

onMounted(() => {
  $skills.GetAPI()
})
</script>
