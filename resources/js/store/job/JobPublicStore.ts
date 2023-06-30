import { ref, computed, reactive } from 'vue'
import { defineStore } from 'pinia'
import { useSessionStorage } from '@vueuse/core'
import axios from 'axios'
import { $Err } from '@/helpers/Debug'

interface contentInt {
  job_location: {
    name: String,
  },
  job_department: {
    name: String,
  },
  job_status: {
    name: String,
  },
  job_type: {
    name: String,
  },
  title: String,
  id: number,
  unposted_at: string,
  description: string,
}
interface resultInt {

}
interface configInt {
  loading: boolean,
}
interface paramsInt {
  search: String,
  selectedLocation: Array<String>,
  selectedDepartments: Array<string>,
  selectedTypes: Array<string>,
  selectedStatus: Array<string>,
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
      .filter((row) => {
        // if(params.selectedLocation.length === 0) return true;
        return params.selectedLocation.includes(row.job_location.name);
      })
      .filter((row) => {
        // if(params.selectedDepartments.length === 0) return true;
        return params.selectedDepartments.includes(row.job_department.name);
      })
      .filter((row) => {
        // if(params.selectedStatus.length === 0) return true;
        return params.selectedStatus.includes(row.job_status.name);
      })
      .filter((row) => {
        // if(params.selectedTypes.length === 0) return true;
        return params.selectedTypes.includes(row.job_type.name);
      })
      .filter((row) => {
        // if(params.search == '') return true;
        return row.title.toLowerCase().indexOf(params.search.toLowerCase()) !== -1;
      })
  })

  async function GetAPI() {
    config.loading = true
    try {
      let { data: { data }} = await axios.get('/api/job-public', {params: params})
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
