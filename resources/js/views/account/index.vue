<template>
  <div>
    <Layout>
      <Form v-slot="{ errors }" :validation-schema="schema" @submit="$general.PostAPI()" class="divide-y divide-gray-200 lg:col-span-9">

          <div class="space-y-6 bg-white py-6 px-4 sm:p-6 sm:rounded-xl">
            <div>
              <h3 class="text-lg font-medium leading-6 text-gray-900">Notifications</h3>
              <p class="mt-1 text-sm text-gray-500">We will notify you by checking the check-box.</p>
            </div>


            <div class="grid grid-cols-2 gap-2">
              <fieldset class="col-span-2 sm:col-span-1 mb-4 sm:mb-0">
                <legend class="text-base font-medium text-gray-900">Notify By Email</legend>
                <div class="mt-4 space-y-4">
                  <div class="flex items-start">
                    <AppCheck
                      v-model="$general.params.notify_email_job"
                      name="email-job"
                      placeholder="New Posted Jobs"
                      desc="Will notify if new job has been posted."
                    />
                  </div>
                  <div class="flex items-start">
                    <AppCheck
                      v-model="$general.params.notify_email_news"
                      name="email-news"
                      placeholder="New Posted News"
                      desc="Will notify if news has been posted."
                    />
                  </div>
                  <div class="flex items-start">
                    <AppCheck
                      v-model="$general.params.notify_email_event"
                      name="email-events"
                      placeholder="Calendar Event"
                      desc="Will notify by calendar event."
                    />
                  </div>
                </div>
              </fieldset>
              <fieldset>
                <legend class="text-base font-medium text-gray-900">Notify by SMS</legend>
                <p class="text-sm text-gray-500">These are delivered via SMS to your mobile phone.</p>
                <div class="mt-4 space-y-4">
                  <div class="flex items-start">
                    <AppCheck
                      v-model="$general.params.notify_sms_job"
                      name="sms-job"
                      placeholder="New Posted Jobs"
                      desc="Will notify if new job has been posted."
                    />
                  </div>
                  <div class="flex items-start">
                    <AppCheck
                      v-model="$general.params.notify_sms_news"
                      name="sms-news"
                      placeholder="New Posted News"
                      desc="Will notify if news has been posted."
                    />
                  </div>
                  <div class="flex items-start">
                    <AppCheck
                      v-model="$general.params.notify_sms_event"
                      name="sms-events"
                      placeholder="Calendar Event"
                      desc="Will notify by calendar event."
                    />
                  </div>
                </div>
              </fieldset>
            </div>

            <div class="text-right justify-end flex">
              <AppButton color="white" type="submit" :disabled="Object.keys(errors).length != 0" :loading="$general.config.buttonLoading" btnCss="w-full sm:w-auto">Save</AppButton>
            </div>
          </div>

      </Form>
  </Layout>
</div>
</template>

<script setup lang="ts">
import { onMounted } from 'vue'
import * as Yup from 'yup'
import { Form, configure } from 'vee-validate'
import { useGeneralSettingsStore } from '@/store/@applicant/GeneralSettingsStore'

import Layout from    './~Components/Layout.vue'
import AppButton from '@/components/form/AppButton.vue'
import AppCheck from  '@/components/form/AppCheck.vue'

configure({
    validateOnInput: true
})

const schema = Yup.object({
})

const $general = useGeneralSettingsStore()

onMounted(() => {
  $general.GetAPI()
})
</script>
