import { reactive, ref } from 'vue'
import { defineStore } from 'pinia'
import { useStorage, StorageSerializers } from '@vueuse/core'
import axios from 'axios'
import { notify } from 'notiwind'
import type { TGConfig } from '../GlobalType'

interface TContent {
  notify_email_job: boolean
  notify_email_news: boolean
  notify_email_event: boolean

  notify_sms_job: boolean
  notify_sms_news: boolean
  notify_sms_event: boolean
}

const title = `applicant/GeneralSettingsStore`
export const useGeneralSettingsStore = defineStore(title, () => {
  const config = reactive<TGConfig>({
    contentLoading: false,
    buttonLoading: false,
    form: '',
  })
  const params = useStorage<TContent>(`${title}/params`, InitParams(), sessionStorage, { serializer: StorageSerializers.object })

  async function GetAPI() {
    config.contentLoading = true
    try {
      let { data: {data}} = await axios.get<TContent>('/api/account/general')
      console.log(data)
      params.value.notify_email_job   = DataToCheckBox(data.notify_email_job)
      params.value.notify_email_news  = DataToCheckBox(data.notify_email_news)
      params.value.notify_email_event = DataToCheckBox(data.notify_email_event)

      params.value.notify_sms_job   = DataToCheckBox(data.notify_sms_job)
      params.value.notify_sms_news  = DataToCheckBox(data.notify_sms_news)
      params.value.notify_sms_event = DataToCheckBox(data.notify_sms_event)
    }
    catch(err) {
      console.log(err)
    }
    config.contentLoading = false
  }

  async function PostAPI() {
    config.buttonLoading = true
    try {
      let { data: {data}} = await axios.post(`/api/account/general`, params.value)
      GetAPI()
      if(data) {
        notify({
          group: "success",
          title: "Successfully updated!",
          text: 'Settings is now changed.'
        }, 5000)
      }
    }
    catch(err) {
      console.log(err)
      notify({
        group: "error",
        title: "Error Update",
        text: 'The inputs may be invalid or server error.'
      }, 5000)
    }
    config.buttonLoading = false
  }

  function InitParams() {
    return {
      notify_email_job: false,
      notify_email_news: false,
      notify_email_event: false,

      notify_sms_job: false,
      notify_sms_news: false,
      notify_sms_event: false,
    }
  }

  function DataToCheckBox(data: integer) {
    return data == 1 ? true : false
  }

  return {
    config,
    params,

    GetAPI,
    PostAPI,
  }
})
