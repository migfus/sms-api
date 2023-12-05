import { reactive } from "vue"
import { defineStore } from "pinia"
import axios from "axios"
import { notify } from 'notiwind'
import { useStorage, StorageSerializers } from '@vueuse/core'
import type { TGConfig } from "../GlobalType"

interface TParams {
  email: string
  password: string,
  confirm_password: string,

  last_name: string
  first_name: string
  mid_name: string
  ext_name: string
  civil_status_id: number
  birth_day: Date
  birth_place_id: number
  blood_type_id: number
  sex: boolean
  height: number
  weight: number
  address_id: number
  address: string,
  mobile: string
}

const title = `auth/RegisterStore`
export const useRegisterStore = defineStore(title, () => {

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
  async function RegisterAPI() {
    config.buttonLoading = true
    try{
      let { data: { data }} = await axios.post('/api/register', params.value)

      console.log('RegisterAPI', data)
      params.value = ResetParams()

      notify({
        group: "success",
        title: "Registration Successful",
        text: 'You can now login using your account.'
      }, 5000)

      //@ts-ignore
      this.router.push({ name: 'login', params: { email: params.value.email }})
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
      email: null,
      password: null,
      confirm_password: null,

      last_name: null,
      first_name: null,
      mid_name: null,
      ext_name: '',
      civil_status_id: 549717001907709,  // Single
      birth_day: null,
      birth_place_id: null,
      blood_type_id: 549716690333042,  // O+
      sex: true, // male
      height: 0,
      weight: 0,
      address_id: null,
      address: null,
      mobile: `09`,
    }
  }

  function Next() {
    //@ts-ignore
    this.router.push({ name: 'fill-register'})
  }

  return {
    params,
    config,

    RegisterAPI,
    Next,
  }
});
