import { reactive } from 'vue'
import { defineStore } from 'pinia'
import { useStorage, StorageSerializers } from '@vueuse/core'
import axios from 'axios'
import { notify } from 'notiwind'
import type { TGConfig } from '../GlobalType'

interface TContent {
  id: number
  name: string
  recognition: string
}

const title = `applicant/SkillStore`
export const useSkillStore = defineStore(title, () => {
  const content = useStorage<TContent[]>(`${title}/content`, null, sessionStorage, { serializer: StorageSerializers.object})
  const config = reactive<TGConfig>({
    loading: false,
  })
  const params = useStorage<TContent>(`${title}/params`, InitParams(), sessionStorage, { serializer: StorageSerializers.object })

  async function GetAPI() {
    config.loading = true
    try {
      let { data: {data}} = await axios.get('/api/profile/skills')
      content.value = data
    }
    catch(err) {
      console.log(err)
    }
    config.loading = false
  }

  async function PostAPI() {
    try {
      let { data: {data}} = await axios.post(`/api/profile/skills`, params.value)
      if(data) {
        GetAPI()
        ChangeForm(null)
        notify({
          group: "success",
          title: "Personal Info updated!",
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
  }

  async function UpdateAPI() {
    try {
      let { data: {data}} = await axios.put(`/api/profile/skills/${params.value.id}`, params.value)
      if(data) {
        GetAPI()
        ChangeForm(null)
        notify({
          group: "success",
          title: "Skill updated!",
          text: 'Skill is now changed.'
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
  }

  async function DestroyAPI() {
    try {
      let { data: {data}} = await axios.delete(`/api/profile/skills/${params.value.id}`)
      if(data) {

        GetAPI()
        notify({
          group: "success",
          title: "Skill Deleted",
          text: 'Your skill is now removed'
        }, 5000)
      }
    }
    catch(err) {
      console.log(err)
      notify({
        group: "error",
        title: "Error Removing Skill",
        text: 'Server error. Try refreshing the page'
      }, 5000)
    }
  }

  function InitParams() {
    return {
      id: -1,
      name: '',
      recognition: ''
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
      config.form = null
      params.value = InitParams()
    }
  }

  return {
    content,
    config,
    params,

    GetAPI,
    UpdateAPI,
    DestroyAPI,
    PostAPI,

    SetIDToDelete,
    ChangeForm,
  }
})
