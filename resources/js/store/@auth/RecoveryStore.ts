import { reactive } from "vue"
import { defineStore } from "pinia"
import axios from "axios"
import { notify } from 'notiwind'
import { useStorage, StorageSerializers } from '@vueuse/core'
import type { TGConfig } from "../GlobalType"

interface TParams {
  code: string
  password: string,
  confirm_password: string,
}

const title = `auth/RecoveryStore`
export const useRecoveryStore = defineStore(title, () => {

  const params = useStorage<TParams>(
    `${title}/params`,
    ResetParams(),
    sessionStorage,
    {serializer: StorageSerializers.object}
  )

  const config = reactive<TGConfig>({
    buttonLoading: false,
    contentLoading: false,
  })

  // SECTION API
  async function PostAPI() {
    config.buttonLoading = true
    try{
      let { data: { data }} = await axios.post('/api/recovery', params.value)
      if(data) {
        notify({
          group: "success",
          title: "Recovery Successful",
          text: 'You can now login using your account.'
        }, 5000)

        params.value = ResetParams()
        //@ts-ignore
        this.router.push({ name: 'login'})
      }
      else {
        notify({
          group: "error",
          title: "Invalid Code",
          text: 'Please use the latest code sent by the email.'
        }, 5000)
      }
    }
    catch(e) {
      if(e.response.data.message != 'Invalid Input') {
        notify({
          group: "error",
          title: "Invalid Code",
          text: 'Please use the latest code sent by the email.'
        }, 5000)
      }
    }
    config.buttonLoading = false
  }

  function ResetParams() {
    return {
      code: null,
      password: null,
      confirm_password: null
    }
  }

  return {
    params,
    config,

    PostAPI,
  }
});
