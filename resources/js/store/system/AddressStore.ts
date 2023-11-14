import axios from 'axios'
import { useStorage, StorageSerializers } from '@vueuse/core'
import { defineStore } from 'pinia'
import type { TGAddress } from '../GlobalType'

const title = `system/AddressStore`
export const useAddressStore = defineStore(title, () => {
  const content = useStorage<Array<TGAddress>>(`${title}/content`, [], localStorage, { serializer: StorageSerializers.object})

  async function GetAPI() {
    try {
      let { data } = await axios.get('/api/public/address')
      content.value = data
      console.error(data)
    }
    catch(err) {
      console.error(err)
    }
  }

  return {
    content,

    GetAPI
  }
})
