import { reactive } from 'vue';
import { defineStore } from 'pinia'
import axios from 'axios'
import { useStorage, StorageSerializers } from '@vueuse/core'

interface TParams {
  currentDate: String
}
interface TConfig {
  loading: boolean
  count: number
}
interface TContent {
  event_category: { name: String }
  title: String
  start: string
  end: String
  display: String
  backgroundColor: String
  textColor: String
  borderColor: String
  eventEnd: Boolean
  eventTime: Boolean
  eventClick: Function
  id: number
}

const title = `event/EventPublicStore`
export const useEventPublicStore = defineStore(title, () => {
  const eventCount = useStorage<Number>(`${title}/eventCount`, 0)
  const content = useStorage<Array<TContent>>(`${title}/content`, [], sessionStorage, {serializer: StorageSerializers.object})
  const params = reactive<TParams>({
    currentDate: '',
  })
  const config = reactive<TConfig>({
    loading: false,
    count: 3
  })

  async function GetAPI() {
    config.loading = true
    try {
      let { data: { data }} = await axios.get('/api/public/event', { params: params })
      content.value = data.map(row => {
          return {
            title: `${row.event_category.name} - ${row.title}`,
            start: row.start,
            end: row.end,
            display: 'block',
            backgroundColor: `#${row.event_category.bg_color}`,
            textColor: `#${row.event_category.text_color}`,
            borderColor: `#${row.event_category.bg_color}`,
            eventEnd: true,
            eventTime: true,
            eventClick: () => { alert() }
          }
        }
      );
    }
    catch(err) {
      console.log(err)
    }
    config.loading = false
  }

  async function GetCountAPI() {
    try {
      let { data: { count}} = await axios.get('/api/public/event/count')
      eventCount.value = count
    }
    catch(err) {
      console.log(err)
    }
  }

  return {
    eventCount,
    params,
    config,
    content,

    GetCountAPI,
    GetAPI,
  }
})
