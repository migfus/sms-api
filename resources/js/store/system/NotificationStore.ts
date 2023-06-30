import { reactive } from "vue";
import { defineStore } from "pinia";
import { $DebugInfo } from '@/helpers/Debug'

interface contentInt {
  name: String
  content: string
  status: String
}
interface configInt {
  show: Boolean
}

export const useNotificationStore = defineStore("system/NotificationStore", () => {
  $DebugInfo('notification');

  const content = reactive<contentInt>({
    name: '',
    content: '',
    status: 'danger',
  })

  const config = reactive<configInt>({
    show: false,
  })

  function Show(name: String, _content , status:String = 'danger') {
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
