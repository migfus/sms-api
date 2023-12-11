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
    }
    catch(err) {
      console.error(err)
    }
  }

  function addressIDToFull(id: number) {
    for (let i = 0; content.value.length > i; i++) {
      const province = content.value[i];
      for (let f = 0; province.cities.length > f; f++) {
        if (province.cities[f].id == id) {
          return `${province.cities[f].name}, ${province.name}`;
        }
      }
    }
    return null;
  }

  function addressIDToName(id: number) {
    for (let i = 0; content.value.length > i; i++) {
      const province = content.value[i];
      for (let f = 0; province.cities.length > f; f++) {
        if (province.cities[f].id == id) {
          return `${province.cities[f].name}`
        }
      }
    }
    return null;
  }

  function addressIDToProvinceName(id: number) {
    for (let i = 0; content.value.length > i; i++) {
      const province = content.value[i];
      for (let f = 0; province.cities.length > f; f++) {
        if (province.cities[f].id == id) {
          return `${province.name}`
        }
      }
    }
    return null;
  }

  function addressIDToZip(id: number) {
    for (let i = 0; content.value.length > i; i++) {
      const province = content.value[i];
      for (let f = 0; province.cities.length > f; f++) {
        if (province.cities[f].id == id) {
          return `${province.cities[f].zipcode}`
        }
      }
    }
    return null;
  }

  return {
    content,

    GetAPI,

    addressIDToFull,
    addressIDToName,
    addressIDToProvinceName,
    addressIDToZip
  }
})
