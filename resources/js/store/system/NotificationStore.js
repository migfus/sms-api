import { reactive } from "vue";
import { defineStore } from "pinia";
import { $DebugInfo } from '@/helpers/Debug'

export const useNotificationStore = defineStore("system/NotificationStore", () => {
  $DebugInfo('notification');

  const content = reactive({
    name: '',
    content: '',
    status: 'danger',
  })

  const config = reactive({
    show: false,
  })

  function Show(name, _content, status = 'danger') {
    Object.assign(content, {
      name: name,
      content: _content,
      status: status,
    });

    config.show = true;

    setTimeout(() => {
      config.show = false
    }, 5000);
  }

  return {
    content,
    config,

    Show,
  }
});
