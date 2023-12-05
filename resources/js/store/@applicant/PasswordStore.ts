import { reactive, } from 'vue'
import { defineStore } from 'pinia'
import { useStorage, StorageSerializers } from '@vueuse/core'
import axios from 'axios'
import { notify } from 'notiwind'
import type { TGConfig } from '../GlobalType'

interface TContent {
  old_pass: string
  pass: string
  confirm_pass: string
}

const title = `applicant/PasswordStore`
export const usePasswordStore = defineStore(title, () => {
  const content = useStorage<TContent>(`${title}/content`, null, sessionStorage, { serializer: StorageSerializers.object})
  const config = reactive<TGConfig>({
    contentLoading: false,
    buttonLoading: false,
    form: '',
  })
  const params = reactive<TContent>(InitParams())

  async function PostAPI() {
    config.buttonLoading = true
    try {
      let { data: {data}} = await axios.post(`/api/account/password`, params)
      console.log(data)
      if(data) {
        notify({
          group: "success",
          title: "Successfully updated!",
          text: 'Password has been changed.'
        }, 5000)
      }
      else {
        notify({
          group: "error",
          title: "Invalid Current Password",
          text: 'Current password does not match.'
        }, 5000)
      }
    }
    catch(err) {
      console.log(err)
      notify({
        group: "error",
        title: "Error",
        text: 'The inputs may be invalid or server error.'
      }, 5000)
    }
    config.buttonLoading = false
  }

  function InitParams() {
    return {
      old_pass: '',
      pass: '',
      confirm_pass: '',
    }
  }

  return {
    content,
    config,
    params,

    PostAPI,
  }
})
