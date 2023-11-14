import { ref, computed, reactive } from 'vue'
import { defineStore } from 'pinia'
import { useStorage, StorageSerializers } from '@vueuse/core'
import axios from 'axios'
import type { TGConfig } from "../GlobalType"

interface TContent {
  job_location: { name: String }
  job_department: { name: String }
  job_status: { name: String }
  job_type: { name: String }
  title: String
  id: number
  unposted_at: string
  description: string
}
interface TResult {
}

const title = `job/JobPublicStore`
export const useJobPublicStore = defineStore(title, () => {
  const content = useStorage<Array<TContent>>(`${title}/content`, [], sessionStorage, {serializer: StorageSerializers.object});
  const result = ref<Array<TResult>>([]);
  const config = reactive<TGConfig>({
    loading: false,
  })
  const query = reactive({
    search: '',
    selectedLocation: [],
    selectedDepartments: [],
    selectedTypes: [],
    selectedStatus: [],
  })

  const filterJobs = computed(() => {
    return content.value
      .filter((row) => query.selectedLocation.includes(row.job_location.name))
      .filter((row) => query.selectedDepartments.includes(row.job_department.name))
      .filter((row) => query.selectedStatus.includes(row.job_status.name))
      .filter((row) => query.selectedTypes.includes(row.job_type.name))
      .filter((row) => row.title.toLowerCase().indexOf(query.search.toLowerCase()) !== -1)
  })

  async function GetAPI() {
    config.loading = true
    try {
      let { data: { data }} = await axios.get('/api/public/job')
      content.value = data
      QueryInit()
    }
    catch (err) {
      console.error('useJobPublicStore GetAPI Error', err);
    }
    config.loading = false
  }

  function QueryInit() {
    Object.assign(query, {
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
    query,
    result,
    filterJobs,

    GetAPI,
    Reset,
  }
});
