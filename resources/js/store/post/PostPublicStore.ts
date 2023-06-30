import { defineStore } from 'pinia'
import { reactive } from 'vue'
import { useStorage } from '@vueuse/core'
import axios from 'axios'

interface contentInt {
  id: number,
  title: string,
  cover: string,
  category: {
    name: string,
  },
  content: string,
  user: {
    id: number,
    email: string,
    avatar: string,
  },
  created_at: string,
}
interface configInt {

}

export const usePostPublicStore = defineStore('post/PostPublicStore', () => {
  const content = useStorage<Array<contentInt>>('post/PostPublicStore/content', []);

  const config = reactive<configInt>({

  });

  async function GetAPI() {
    try {
      let { data: { data }} = await axios.get('/api/post')
      content.value = data;
    }
    catch(err) {
      console.log('error');
    }
  }

  return {
    config,
    content,

    GetAPI,
  }
});
