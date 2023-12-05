import { reactive, watch } from 'vue'
import { defineStore } from 'pinia'
import { useStorage, StorageSerializers } from '@vueuse/core'
import axios from 'axios'
import { notify } from 'notiwind'
import type { TGConfig } from '../GlobalType'

interface TContent {
  number: string
  id: number
}

const title = `applicant/MobileNumberStore`
export const useMobileNumberStore = defineStore(title, () => {
  const content = useStorage<TContent[]>(`${title}/content`, null, sessionStorage, { serializer: StorageSerializers.object})
  const config = reactive<TGConfig>({
    contentLoading: false,
    buttonLoading: false,
    form: ''
  })
  const params = useStorage<TContent>(`${title}/params`, InitParams(), sessionStorage, { serializer: StorageSerializers.object })
  const query = reactive<{ search: string }>({
    search: ''
  })

  async function GetAPI() {
    config.contentLoading = true
    try {
      let { data: {data}} = await axios.get('/api/profile/mobile-number', { params: { search: query.search }})
      content.value = data
    }
    catch(err) {
      console.log(err)
    }
    config.contentLoading = false
  }

  async function PostAPI() {
    config.buttonLoading = true
    try {
      let { data: {data}} = await axios.post(`/api/profile/mobile-number`, params.value)
      if(data) {
        GetAPI()
        ChangeForm(null)
        notify({
          group: "success",
          title: "Successfully updated!",
          text: 'Personal Info is now changed.'
        }, 5000)
      }
    }
    catch(err) {
      console.log(err)
      notify({
        group: "error",
        title: "Error",
        text: 'The inputs may be invalid or server error.'
      }, 5000)
    }
    config.buttonLoading = false
  }

  async function UpdateAPI() {
    config.buttonLoading = true
    try {
      let { data: {data}} = await axios.put(`/api/profile/mobile-number/${params.value.id}`, params.value)
      if(data) {
        GetAPI()
        ChangeForm(null)
        notify({
          group: "success",
          title: "Successfully updated!",
          text: 'Personal Info is now changed.'
        }, 5000)
      }
    }
    catch(err) {
      console.log(err)
      notify({
        group: "error",
        title: "Error",
        text: 'The inputs may be invalid or server error.'
      }, 5000)
    }
    config.buttonLoading = false
  }

  async function DestroyAPI() {
    config.buttonLoading = true
    try {
      let { data: {data}} = await axios.delete(`/api/profile/mobile-number/${params.value.id}`)
      if(data) {

        GetAPI()
        notify({
          group: "success",
          title: "Successfully Deleted",
          text: 'Your mobile number is now removed'
        }, 5000)
      }
    }
    catch(err) {
      console.log(err)
      notify({
        group: "error",
        title: "Error Removing Number",
        text: 'Server error. Try refreshing the page'
      }, 5000)
    }
    config.buttonLoading = false
  }

  function InitParams() {
    return {
      number: null,
      id: -1
    }
  }

  function SetIDToDelete(id: number) {
    params.value.id = id
  }

  function ChangeForm(row?: TContent, formMode = null) {
    if(formMode == 'update') {
      config.form = 'update'
      params.value = row
    }
    else if(formMode == 'create') {
      config.form = 'create'
    }
    else {
      config.form = ''
      params.value = InitParams()
    }
  }

  return {
    content,
    config,
    params,
    query,

    GetAPI,
    UpdateAPI,
    DestroyAPI,
    PostAPI,

    SetIDToDelete,
    ChangeForm,
  }
})
