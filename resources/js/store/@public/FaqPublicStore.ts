import { ref, reactive } from 'vue'
import { defineStore } from 'pinia'
import axios from 'axios'
import type { TGConfig, TGQuery } from "../GlobalType"

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

const title = `faq/FaqPublicStore`
export const useFaqPublicStore = defineStore(title, () => {
  const content = ref<Array<TContent>>([])
  const config = reactive<TGConfig>({
    loading: false,
  })
  const params = reactive<TGQuery>({
    search: ``,
    sort: `ASC`
  })

  async function GetAPI() {
    config.loading = true
    try {
      let { data: { data }} = await axios.get('/api/public/faq', { params: params})
      content.value = data
    }
    catch(err) {
      console.error(err)
    }
    config.loading = false
  }

  return {
    content,
    config,
    params,

    GetAPI,
  }
});
