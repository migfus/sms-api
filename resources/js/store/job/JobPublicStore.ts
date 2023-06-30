import { ref, computed, reactive } from 'vue'
import { defineStore } from 'pinia'
import { useSessionStorage } from '@vueuse/core'
import axios from 'axios'
import { $Err } from '@/helpers/Debug'

interface contentInt {
  job_location: { name: String }
  job_department: { name: String }
  job_status: { name: String }
  job_type: { name: String }
  title: String
  id: number
  unposted_at: string
  description: string
}
interface resultInt {
}
interface configInt {
  loading: boolean
}

export const useJobPublicStore = defineStore('job/JobPublicStore', () => {
  const content = useSessionStorage<Array<contentInt>>('job/JobPublicStore/content', []);
  const result = ref<Array<resultInt>>([]);
  const config = reactive<configInt>({
    loading: false,
  })
  const params = reactive({
    search: '',
    selectedLocation: [],
    selectedDepartments: [],
    selectedTypes: [],
    selectedStatus: [],
  })

  const filterJobs = computed(() => {
    return content.value
      .filter((row) => params.selectedLocation.includes(row.job_location.name))
      .filter((row) => params.selectedDepartments.includes(row.job_department.name))
      .filter((row) => params.selectedStatus.includes(row.job_status.name))
      .filter((row) => params.selectedTypes.includes(row.job_type.name))
      .filter((row) => row.title.toLowerCase().indexOf(params.search.toLowerCase()) !== -1)
  })

  async function GetAPI() {
    config.loading = true
    try {
      let { data: { data }} = await axios.get('/api/public/job')
      content.value = data
      ParamsInit()
    }
    catch (err) {
      $Err('useJobPublicStore GetAPI Error', err);
    }
    config.loading = false
  }

  function ParamsInit() {
    Object.assign(params, {
      search: '',
      selectedLocation:    [...new Set(content.value.map(row => row.job_location.name))],
      selectedDepartments: [...new Set(content.value.map(row => row.job_department.name))],
      selectedTypes:       [...new Set(content.value.map(row => row.job_type.name))],
      selectedStatus:      [...new Set(content.value.map(row => row.job_status.name))],
    })
  }

  function Reset() {
    GetAPI()
  }


  return {
    content,
    config,
    params,
    result,
    filterJobs,

    GetAPI,
    Reset,
  }

});
