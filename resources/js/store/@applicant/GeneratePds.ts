import { reactive, ref } from 'vue'
import { defineStore } from 'pinia'
import { useStorage, StorageSerializers } from '@vueuse/core'
import axios from 'axios'
import { notify } from 'notiwind'
import type { TGConfig } from '../GlobalType'

interface TContent {

}
interface TUploadContent {
  id: number
  file: any
}

const title = `applicant/GeneratePdsStore`
export const useGeneratePdsStore = defineStore(title, () => {
  const content = ref<TContent>(null)
  const config = reactive<TGConfig>({
    contentLoading: false,
    buttonLoading: false,
  })

  async function GetAPI() {
    config.contentLoading = true
    try {
      let { data: {data}} = await axios.get('/api/profile/generate-pds')
      content.value = data
    }
    catch(err) {
      console.log(err)
    }
    config.contentLoading = false
  }

  function InitParams() {
    return null
  }

  return {
    content,
    config,

    GetAPI,
  }
})
