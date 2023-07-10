import axios from 'axios'
import { useStorage } from '@vueuse/core'
import { defineStore } from 'pinia'

export const useAddressStore = defineStore('system/AddressStore', () => {
  const content = useStorage('sytem/AddressStore/content', [], localStorage)

  async function GetAPI() {
    try {
      let { data } = await axios.get('/api/public/address')
      content.value = data
      console.log(data)
    }
    catch(err) {
      console.log(err)
    }
  }

  return {
    content,

    GetAPI
  }
})
