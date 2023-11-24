import { reactive } from 'vue'
import { defineStore } from 'pinia'
import { useStorage, StorageSerializers } from '@vueuse/core'
import axios from 'axios'
import type { TGConfig } from '../GlobalType'

interface TContent {
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
  address: string

  gsis_id: string
  pagibig_id: string
  tin_id: string

  avatar: string
}

const title = `auth/PersonalStore`
export const usePersonalStore = defineStore(title, () => {
  const content = useStorage<Array<TContent>>(`${title}/content`, [], sessionStorage, { serializer: StorageSerializers.object})
  const config = reactive<TGConfig>({
    loading: false,
  })
  const params = useStorage<TContent>(`${title}/params`, InitParams(), sessionStorage, { serializer: StorageSerializers.object })

  async function GetAPI() {
    config.loading = true
    try {
      let { data: {data}} = await axios.get('/api/auth/profile/personal')
      content.value = data
      console.log(data)
    }
    catch(err) {
      console.log(err)
    }
    config.loading = false
  }

  function InitParams() {
    return {
      last_name: '',
      first_name: '',
      mid_name: '',
      ext_name: '',

      civil_status_id: null,
      birth_day: null,
      birth_place_id: null,
      blood_type_id: null,
      sex: false,
      height: null,
      weight: null,
      address_id: null,
      address: '',

      gsis_id: null,
      pagibig_id: null,
      tin_id: null,

      avatar: null
    }
  }

  return {
    content,
    config,
    params,

    GetAPI,
  }
})
