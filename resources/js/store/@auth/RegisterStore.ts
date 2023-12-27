import { reactive } from "vue"
import { defineStore } from "pinia"
import axios from "axios"
import { notify } from 'notiwind'
import type { TGConfig } from "../GlobalType"

interface TParams {
  last_name: string
  first_name: string
  mid_name: string
  ext_name: string
  department_id: number
  unit_id: number
  position: string
  picture: any

  mobile: string
  email: string
}

const title = `auth/RegisterStore`
export const useRegisterStore = defineStore(title, () => {

  const params = reactive<TParams>(ResetParams())

  const config = reactive<TGConfig>({
    buttonLoading: false,
    contentLoading: false,
  })

  // SECTION API
  async function RegisterAPI() {
    config.buttonLoading = true
    try{
      let { data: { data }} = await axios.post('/api/register', params)

      console.log('RegisterAPI', data)
      Object.assign(params, ResetParams())

      notify({
        group: "success",
        title: "Registration Successful",
        text: 'You can now login using your account.'
      }, 5000)
    }
    catch(e) {
      if(e.response.data.message != 'Invalid Input') {
        notify({
          group: "error",
          title: "Invalid Credentials",
          text: 'Mistyped? Please try again.'
        }, 5000)
      }
    }
    config.buttonLoading = false
  }

  function ResetParams() {
    return {
      last_name: null,
      first_name: null,
      mid_name: null,
      ext_name: '',
      department_id: null,
      unit_id: null,
      email: null,
      mobile: null,
      position: null,
      picture: null,
    }
  }

  return {
    params,
    config,

    RegisterAPI,
  }
});
