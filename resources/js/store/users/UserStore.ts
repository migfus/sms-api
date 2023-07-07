import { ref, reactive } from 'vue'
import { defineStore} from 'pinia'
import { useStorage } from '@vueuse/core'
import axios from 'axios'

interface configInt {
  loading: boolean
}
interface paramsInt {
  search: string
  dateRange: Array<string>,
  filter: string,
}

export const useUserStore = defineStore('users/UserStore', () => {
  const config = reactive<configInt>({
    loading: false
  })
  const content = useStorage('users/UserStore/content', null, sessionStorage)
  const params = reactive<paramsInt>({
    search: '',
    dateRange: ['', ''],
    filter: 'Name',
  })

  async function GetAPI() {
    config.loading = true
    try {
      let { data: {data}} = await axios.get('/api/users', {params: params})
      content.value = data
    }
    catch(err) {
      console.log(err)
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
