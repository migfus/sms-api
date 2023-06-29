import { ref, reactive } from 'vue';
import { defineStore } from 'pinia'
import axios from 'axios'
import { useSessionStorage } from '@vueuse/core'

export const useEventPublicStore = defineStore('store/EventPublicStore', () => {
  const eventCount = useSessionStorage('EventPublic/eventCount', 0)
  const content = useSessionStorage('EventPublic/content', [])
  const params = reactive({
    currentDate: '',
  })
  const config = reactive({
    loading: false,
    count: 3
  })

  async function GetAPI() {
    config.loading = true
    try {
      let { data: { data }} = await axios.get('/api/event-public', { params: params })
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
      let { data: { count}} = await axios.get('/api/event-public/count')
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
