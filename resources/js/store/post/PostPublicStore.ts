import { defineStore } from 'pinia'
import { reactive } from 'vue'
import { useStorage } from '@vueuse/core'
import axios from 'axios'

interface contentInt {
  id: number
  title: string
  cover: string
  category: { name: string }
  content: string
  user: {
    id: number
    email: string
    avatar: string
  }
  created_at: string
}
interface configInt {
  loading: boolean
}
interface paramsInt {
  search: string
}

export const usePostPublicStore = defineStore('post/PostPublicStore', () => {
  const content = useStorage<Array<contentInt>>('post/PostPublicStore/content', []);
  const config = reactive<configInt>({
    loading: false
  });
  const params = reactive<paramsInt>({
    search: ''
  })

  async function GetAPI() {
    config.loading = true
    try {
      let { data: { data }} = await axios.get('/api/public/post', { params: params})
      content.value = data;
    }
    catch(err) {
      console.log('error');
    }
    config.loading = false
  }

  return {
    config,
    content,
    params,

    GetAPI,
  }
});
