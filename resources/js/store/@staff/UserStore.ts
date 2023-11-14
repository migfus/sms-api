import { reactive } from 'vue'
import { defineStore} from 'pinia'
import { useStorage, StorageSerializers } from '@vueuse/core'
import axios from 'axios'
import type { TGQuery } from '../GlobalType'

interface TConfig {
  loading: boolean
  loadingDestroy: boolean
  open: boolean
  deleteID: number
}

const title = `users/UserStore`
export const useUserStore = defineStore(title, () => {
  const config = reactive<TConfig>({
    loading: false,
    loadingDestroy: false,
    open: false,
    deleteID: null,
  })
  const content = useStorage(`${title}/content`, [], sessionStorage, {serializer: StorageSerializers.object})
  const query = reactive<TGQuery>({
    search: '',
    start: null,
    end: null,
    sort: `ASC`,
    filter: 'Name',
  })

  async function GetAPI() {
    config.loading = true
    try {
      let { data: {data}} = await axios.get('/api/users', {params: query})
      // NOTE Insert [open] value for open/close details toggle
      const contentData = data.data
      contentData.map(row => {
        row.open = config.open
        return {
          ...row,
        }
      })
      content.value = data
      content.value.data = contentData
    }
    catch(err) {
      console.log(err)
    }
    config.loading = false
  }

  async function DestroyAPI() {
    config.loadingDestroy = true
    try {
      let { data: {data}} = await axios.delete(`/api/users/${config.deleteID}`)
      console.log(data)
      config.deleteID = null
      GetAPI()
    }
    catch(err) {
      console.log(err)
    }
    config.loadingDestroy = false
  }

  const toggleOpen = () => {
    config.open = !config.open
    content.value.data.map(row => row.open = config.open)
  }

  return {
    config,
    content,
    query,

    GetAPI,
    toggleOpen,
    DestroyAPI
  }
});
