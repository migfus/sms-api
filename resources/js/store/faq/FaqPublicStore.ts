import { ref, reactive } from 'vue'
import { defineStore } from 'pinia'
import axios from 'axios'

interface contentInt {
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
interface configInt {
  loading: boolean
}
interface paramsInt {
  search: string,
}

export const useFaqPublicStore = defineStore('faq/FaqPublicStore', () => {
  const content = ref<Array<contentInt>>([])
  const config = reactive<configInt>({
    loading: false,
  })
  const params = reactive<paramsInt>({
    search: '',
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
