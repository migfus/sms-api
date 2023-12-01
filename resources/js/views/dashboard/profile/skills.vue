<template>
  <div>
    <Layout>
      <div class="divide-y divide-gray-200 lg:col-span-9">

        <!-- SECTION FORM -->
        <BasicTransition>
          <!-- NOTE CREATE -->
          <FormCard
            v-if="$skills.config.form == 'create'"
            v-slot="{errors}" title="Add Skill"
            :loading="$skills.config.buttonLoading"
            :formSchema="schema"
            submitButtonName="Create"
            @submitForm="$skills.PostAPI()"
            @cancelClick="$skills.ChangeForm(null)"
          >
            <div class="col-span-6">
                <AppInput v-model="$skills.params.name" placeholder="Skill" name="skill" :errors="errors"/>
            </div>
            <div class="col-span-6">
                <AppInput v-model="$skills.params.recognition" placeholder="Recognition" name="recognition" :errors="errors"/>
            </div>
          </FormCard>
          <!-- NOTE UPDATE -->
          <FormCard
            v-if="$skills.config.form == 'update'"
            v-slot="{errors}" title="Update Skill"
            :loading="$skills.config.buttonLoading"
            :formSchema="schema_update"
            submitButtonName="Update"
            @submitForm="$skills.UpdateAPI()"
            @cancelClick="$skills.ChangeForm(null)"
          >
            <div class="col-span-6">
                <AppInput v-model="$skills.params.name" placeholder="Skill" name="skill" :errors="errors"/>
            </div>
            <div class="col-span-6">
                <AppInput v-model="$skills.params.recognition" placeholder="Recognition" name="recognition" :errors="errors"/>
            </div>
          </FormCard>

        </BasicTransition>

        <!-- SECTION CONTENT -->
        <ContentCard
          title="Skills"
          :form="$skills.config.form"
          :buttonLoading="$skills.config.buttonLoading"
          :contentLoading="$skills.config.contentLoading"
          @actionCreateClick="$skills.ChangeForm(null, 'create')"
          @actionCancelClick="$skills.ChangeForm(null)"
        >
          <template #search>
            <AppInput v-model="$skills.query.search" name="search" placeholder="Search" noLabel/>
          </template>
          <template #default>
            <DataTransition>
              <li v-for="row in $skills.content" :key="row.id">
                <div class="block hover:bg-gray-50">
                  <div class="px-4 py-4 sm:px-6">
                    <div class="flex items-center justify-between">
                      <p class="truncate text-sm font-medium text-primary-600">{{ row.name }}</p>
                      <div class="ml-2 flex flex-shrink-0">
                        <AppButton @click="$skills.ChangeForm(row, 'update')" color='white' class="mr-2" size="sm" :loading="$skills.config.buttonLoading">Edit</AppButton>
                        <AppButton @click="showPrompt = true; $skills.SetIDToDelete(row.id)" color='danger' size="sm" :loading="$skills.config.buttonLoading">Remove</AppButton>
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
            </DataTransition>
          </template>

        </ContentCard>

      </div>
    </Layout>
  </div>

  <PromptModal title="Remove this Number?" confirmButtonName="Remove" @confirm="$skills.DestroyAPI()" v-model="showPrompt">
    <p class="text-gray-500">Are you sure you want to remove this number? This action cannot be undone.</p>
  </PromptModal>
</template>

<script setup lang="ts">
import { onMounted, ref, watch } from 'vue'
import * as Yup from 'yup'
import { useSkillStore } from '@/store/@applicant/SkillStore'
import { CheckBadgeIcon } from '@heroicons/vue/24/outline'
import { useDebounceFn } from '@vueuse/core'

import Layout from     './~Components/Layout.vue'
import Loader from     './~Components/Loader.vue'
import FormCard from   './~Components/FormCard.vue'
import ContentCard from'./~Components/ContentCard.vue'
import AppInput from    '@/components/form/AppInput.vue'
import PromptModal from '@/components/modals/PromptModal.vue'
import AppButton from   '@/components/form/AppButton.vue'
import BasicTransition from '@/components/transitions/BasicTransition.vue'
import DataTransition from  '@/components/transitions/DataTransition.vue'

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
watch($skills.query, useDebounceFn(() => {
  $skills.GetAPI()
}, 600))
</script>
