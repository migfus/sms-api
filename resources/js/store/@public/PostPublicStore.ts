import { defineStore } from 'pinia'
import { reactive } from 'vue'
import { useStorage, StorageSerializers } from '@vueuse/core'
import axios from 'axios'
import type { TGConfig, TGQuery } from "../GlobalType"

interface TContent {
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

const title = `post/PostPublicStore`
export const usePostPublicStore = defineStore(title, () => {
  const content = useStorage<Array<TContent>>(`${title}/content`, [], sessionStorage, {serializer: StorageSerializers.object});
  const config = reactive<TGConfig>({
    loading: false
  });
  const query = reactive<TGQuery>({
    search: '',
    sort: `ASC`
  })

  async function GetAPI() {
    config.loading = true
    try {
      let { data: { data }} = await axios.get('/api/public/post', { params: query})
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
    query,

    GetAPI,
  }
});
