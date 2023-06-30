import { defineStore } from 'pinia'
import { reactive } from 'vue'
import type { RouteRecordName } from 'vue-router'

interface configInt {
  loading: boolean
  to: RouteRecordName
}

export const usePreLoader = defineStore('system/PreLoader', () => {
  const config = reactive<configInt>({
    loading: false,
    to: 'home'
  });

  return {
    config,
  }
});
