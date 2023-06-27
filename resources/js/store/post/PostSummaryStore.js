import { defineStore } from 'pinia'
import { reactive } from 'vue'
import { useStorage } from '@vueuse/core'
import axios from 'axios'

export const usePostSummary = defineStore('post-summary', () => {
  const content = useStorage('post-summary', []);

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
