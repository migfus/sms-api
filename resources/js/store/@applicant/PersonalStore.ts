import { reactive, ref } from 'vue'
import { defineStore } from 'pinia'
import { useStorage, StorageSerializers } from '@vueuse/core'
import axios from 'axios'
import { notify } from 'notiwind'
import type { TGConfig } from '../GlobalType'
import { cityIDToProvinceID } from '@/helpers/Converter'
import { useAuthStore } from '../@auth/AuthStore'

interface TContent {
  id: number
  last_name: string
  first_name: string
  mid_name: string
  ext_name: string

  civil_status_id: number
  birth_day: Date
  birth_place_id: number
  blood_type_id: number
  sex: string
  height: number
  weight: number
  address_id: number
  address_barangay: string
  address_street: string
  address: string

  gsis_id: string
  pagibig_id: string
  tin_id: string
  philhealth_id: string
  sss_id: string
  agency_id: string

  avatar: string
}

const $auth = useAuthStore()

const title = `applicant/PersonalStore`
export const usePersonalStore = defineStore(title, () => {
  const content = useStorage<TContent>(`${title}/content`, null, sessionStorage, { serializer: StorageSerializers.object})
  const config = reactive<TGConfig>({
    contentLoading: false,
    buttonLoading: false,
    form: '',
  })
  const params = useStorage<TContent>(`${title}/params`, InitParams(), sessionStorage, { serializer: StorageSerializers.object })

  const bday_province_id = ref(16)
  const address_province_id = ref(16)

  async function GetAPI() {
    config.contentLoading = true
    try {
      let { data: {data}} = await axios.get('/api/profile/personal')
      bday_province_id.value = cityIDToProvinceID(data.birth_place_id)
      address_province_id.value = cityIDToProvinceID(data.address_id)

      content.value = data
      params.value = data
      params.value.sex = data.sex ? 'true' : 'false'
    }
    catch(err) {
      console.log(err)
    }
    config.contentLoading = false
  }

  async function UpdateAPI() {
    config.buttonLoading = true
    try {
      let { data: {data}} = await axios.put(`/api/profile/personal/${params.value.id}`, params.value)
      if(data) {
        $auth.content.auth.avatar = params.value.avatar
        notify({
          group: "success",
          title: "Successfully updated!",
          text: 'Personal Info is now changed.'
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
      id: -1,
      last_name: '',
      first_name: '',
      mid_name: '',
      ext_name: '',

      civil_status_id: null,
      birth_day: null,
      birth_place_id: null,
      blood_type_id: null,
      sex: 'true',
      height: null,
      weight: null,
      address_id: null,
      address_barangay: '',
      address_street: '',
      address: '',

      gsis_id: null,
      pagibig_id: null,
      tin_id: null,
      philhealth_id: null,
      sss_id: null,
      agency_id: null,

      avatar: null
    }
  }

  return {
    content,
    config,
    params,
    bday_province_id,
    address_province_id,

    GetAPI,
    UpdateAPI,
  }
})
