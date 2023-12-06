import { reactive } from 'vue'
import { defineStore } from 'pinia'
import axios from 'axios'
import type { TGConfig, TGQuery } from "../GlobalType"
import { useStorage, StorageSerializers } from '@vueuse/core'

interface TContent {
  category: { name: string }
  content: string
  cover: string
  created_at: string
  id: number
  title: string
  user: { email: string }
  question: string
  answer: string
}

const title = `public/FaqPublicStore`
export const useFaqPublicStore = defineStore(title, () => {
  const content = useStorage<Array<TContent>>(`${title}/content`, [], sessionStorage, {serializer: StorageSerializers.object});
  const config = reactive<TGConfig>({
    buttonLoading: false,
    contentLoading: false,
  })
  const params = reactive<TGQuery>({
    search: ``,
    sort: `ASC`
  })

  async function GetAPI() {
    config.contentLoading = true
    try {
      let { data: { data }} = await axios.get('/api/public/faq', { params: params})
      content.value = data
    }
    catch(err) {
      console.error(err)
    }
    config.contentLoading= false
  }

  return {
    content,
    config,
    params,

    GetAPI,
  }
});
