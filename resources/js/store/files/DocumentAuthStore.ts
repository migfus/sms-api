import { reactive } from 'vue'
import { defineStore } from 'pinia'
import { useStorage, StorageSerializers } from '@vueuse/core'
import axios from 'axios'

interface contentInt {
  id: number
  created_at: string
  filename: string
  person_id: number
  url: string
  size: number
}
interface configInt {
  loading: boolean
  deleteID?: number
}

export const useDocumentAuthStore = defineStore('auth/DocumentAuthStore', () => {
  const content = useStorage<Array<contentInt>>('auth/DocumentAuthStore/content', [], sessionStorage, { serializer: StorageSerializers.object})
  const config = reactive<configInt>({
    loading: false,
    deleteID: null,
  })

  async function GetAPI() {
    config.loading = true
    try {
      let { data: {data}} = await axios.get('/api/auth/document')
      content.value = data
      console.log(data)
    }
    catch(err) {
      console.log(err)
    }
    config.loading = false
  }

  async function DestroyAPI() {
    try{
      let { data } = await axios.delete(`/api/auth/document/${config.deleteID}`)
      console.log(data)
    }
    catch(err) {
      console.log(err)
    }
    config.deleteID = null
    GetAPI()
  }

  return {
    content,
    config,

    GetAPI,
    DestroyAPI
  }
})
