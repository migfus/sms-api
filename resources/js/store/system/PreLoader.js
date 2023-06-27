import { defineStore } from 'pinia'
import { reactive } from 'vue'

export const usePreLoader = defineStore('system-preLoader', () => {
  const config = reactive({
    loading: false,
    to: 'home'
  });

  return {
    config,
  }
});
