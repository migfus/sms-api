<template>
  <div>
    <Layout>
      <div class="divide-y divide-gray-200 lg:col-span-9">

        <!-- SECTION FORMS -->
        <BasicTransition>
          <!-- NOTE ADD -->
          <FormCard
            v-if="$mobiles.config.form == 'create'"
            v-slot="{errors}"
            title="Create Mobile Number"
            :loading="$mobiles.config.buttonLoading"
            :formSchema="schema"
            submitButtonName="Create"
            @submitForm="$mobiles.PostAPI()"
            @cancelClick="$mobiles.ChangeForm(null)"
          >
            <div class="col-span-12">
                <AppInput v-model="$mobiles.params.number" placeholder="New Number" name="number" type="number" :errors="errors"/>
            </div>
          </FormCard>
          <!-- NOTE UPDATE -->
          <FormCard
            v-if="$mobiles.config.form == 'update'"
            v-slot="{errors}"
            title="Update Mobile Number"
            :loading="$mobiles.config.buttonLoading"
            :formSchema="schema_update"
            submitButtonName="Update"
            @submitForm="$mobiles.UpdateAPI()"
            @cancelClick="$mobiles.ChangeForm(null)"
          >
            <div class="col-span-12">
                <AppInput v-model="$mobiles.params.number" placeholder="New Number" name="number" type="number" :errors="errors"/>
            </div>
          </FormCard>
        </BasicTransition>

        <!-- SECTION CONTENT -->
        <ContenCard
          v-model="$mobiles.query.search"
          title="Mobile Numbers"
          :form="$mobiles.config.form"
          :buttonLoading="$mobiles.config.buttonLoading"
          :contentLoading="$mobiles.config.contentLoading"
          @actionCreateClick="$mobiles.ChangeForm(null, 'create')"
          @actionCancelClick="$mobiles.ChangeForm(null)"
        >
          <template #search>
            <AppInput v-model="$mobiles.query.search" name="search" placeholder="Search" noLabel/>
          </template>
          <template #default>
            <DataTransition>
              <li v-for="row in $mobiles.content" :key="row.id">
                <div class="block hover:bg-gray-50">
                  <div class="px-4 py-4 sm:px-6">
                    <div class="flex items-center justify-between">
                      <p class="truncate text-md font-medium text-primary-600">{{ mobileToFormatted(row.number) }}</p>
                      <div class="ml-2 flex flex-shrink-0">
                        <AppButton @click="$mobiles.ChangeForm(row, 'update')" color='white' class="mr-2" size="sm" :loading="$mobiles.config.buttonLoading">Edit</AppButton>
                        <AppButton @click="showPrompt = true; $mobiles.SetIDToDelete(row.id)" color='danger' size="sm" :loading="$mobiles.config.buttonLoading">Remove</AppButton>
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

  <PromptModal title="Remove this Number?" confirmButtonName="Remove" @confirm="$mobiles.DestroyAPI()" v-model="showPrompt">
    <p class="text-gray-500">Are you sure you want to remove this number? This action cannot be undone.</p>
  </PromptModal>
</template>

<script setup lang="ts">
import { onMounted, ref, watch } from 'vue'
import * as Yup from 'yup'
import { useMobileNumberStore } from '@/store/@applicant/MobileNumberStore'
import { mobileToFormatted } from '@/helpers/Converter'
import { useDebounceFn } from '@vueuse/core'

import Layout from     './~Components/Layout.vue'
import Loader from     './~Components/Loader.vue'
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

const $mobiles = useMobileNumberStore()
const showPrompt = ref(false)

onMounted(() => {
  $mobiles.GetAPI()
})
watch($mobiles.query, useDebounceFn(() => {
  $mobiles.GetAPI()
}, 600))
</script>
