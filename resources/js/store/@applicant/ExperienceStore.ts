import { reactive, watch } from 'vue'
import { defineStore } from 'pinia'
import { useStorage, StorageSerializers } from '@vueuse/core'
import axios from 'axios'
import { notify } from 'notiwind'
import type { TGConfig } from '../GlobalType'

interface TContent {
  id: number
  position: string
  company: string
  from: Date
  to: Date
  salary: number
  salary_type_id: number
  sg: number
  work_status_id: number
  is_government: boolean
  work_status: {
    name: string
  }
}

const title = `applicant/ExperienceStore`
export const useExperienceStore = defineStore(title, () => {
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
      let { data: {data}} = await axios.get('/api/profile/experience', { params: query })
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
      let { data: {data}} = await axios.post(`/api/profile/experience`, params.value)
      if(data) {
        GetAPI()
        ChangeForm(null)
        notify({
          group: "success",
          title: "Successfully added",
          text: 'New experience added to record.'
        }, 5000)
      }
    }
    catch(err) {
      console.log(err)
      notify({
        group: "error",
        title: "Error Adding record",
        text: 'The inputs may be invalid or server error.'
      }, 5000)
    }
    config.buttonLoading = false
  }

  async function UpdateAPI() {
    config.buttonLoading = true
    try {
      let { data: {data}} = await axios.put(`/api/profile/experience/${params.value.id}`, params.value)
      if(data) {
        GetAPI()
        ChangeForm(null)
        notify({
          group: "success",
          title: "Successfully updated!",
          text: 'Selected experience is updated.'
        }, 5000)
      }
    }
    catch(err) {
      console.log(err)
      notify({
        group: "error",
        title: "Error Update",
        text: 'The inputs may be invalid or server error.'
      }, 5000)
    }
    config.buttonLoading = false
  }

  async function DestroyAPI() {
    config.buttonLoading = true
    try {
      let { data: {data}} = await axios.delete(`/api/profile/experience/${params.value.id}`)
      if(data) {

        GetAPI()
        notify({
          group: "success",
          title: "Successfully removed",
          text: 'Selected experience is removed'
        }, 5000)
      }
    }
    catch(err) {
      console.log(err)
      notify({
        group: "error",
        title: "Error Removing Experience",
        text: 'Server error. Try refreshing the page'
      }, 5000)
    }
    config.buttonLoading = false
  }

  function InitParams() {
    return {
      id: -1,
      position: '',
      company: '',
      from: null,
      to: null,
      salary: 0,
      salary_type_id: 1,
      sg: 0,
      is_government: false,
      work_status_id: -1,
      work_status: { name: ''}
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
