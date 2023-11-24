import { reactive } from "vue"
import { defineStore } from "pinia"
import axios from "axios"
import { notify } from 'notiwind'
import { useStorage, StorageSerializers } from '@vueuse/core'
import type { TGConfig } from "../GlobalType"

interface TParams {
  email: string
}

const title = `auth/ForgotStore`
export const useForgotStore = defineStore(title, () => {

  const params = useStorage<TParams>(
    `${title}/params`,
    ResetParams(),
    sessionStorage,
    {serializer: StorageSerializers.object}
  )

  const config = reactive<TGConfig>({
    loading: false,
  })

  // SECTION API
  async function PostAPI() {
    config.loading = true
    try{
      let { data: { data }} = await axios.post('/api/forgot', params.value)
      if(data) {
        notify({
          group: "success",
          title: "Recovery Code Sent Successful",
          text: 'You can check on the code in your email.'
        }, 5000)

        params.value = ResetParams()
        //@ts-ignore
        this.router.push({ name: 'login'})
      }
      else {
        notify({
          group: "error",
          title: "Email Don't Exist!",
          text: 'The email may be mistype or not exist on this website.'
        }, 5000)
      }
    }
    catch(e) {
      if(e.response.data.message != 'Invalid Input') {
        notify({
          group: "error",
          title: "Email Don't Exist!",
          text: 'The email may be mistype or not exist on this website.'
        }, 5000)
      }
    }
    config.loading = false
  }

  function ResetParams() {
    return {
      email: ''
    }
  }

  return {
    params,
    config,

    PostAPI,
  }
});
