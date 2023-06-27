import { useStorage } from '@vueuse/core'
import { defineStore } from 'pinia'

export const useUserData = defineStore('system-userData', () => {
  const content = useStorage('user-data', {
    focusedHistory: [],
    windowSize: {},
    bluetoothDevices: [],
    preferredLanguage: [],
    pixelRatio: 1,
    coords: {},
  });

  return {
    content,
  }
});
