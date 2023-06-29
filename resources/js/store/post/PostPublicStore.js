import { defineStore } from 'pinia'
import { reactive } from 'vue'
import { useStorage } from '@vueuse/core'
import axios from 'axios'

export const usePostPublicStore = defineStore('post/PostPublicStore', () => {
  const content = useStorage('post/PostPublicStore/content', []);

  const config = reactive({

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
