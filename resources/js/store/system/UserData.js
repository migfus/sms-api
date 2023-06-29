import { useStorage } from '@vueuse/core'
import { defineStore } from 'pinia'

export const useUserData = defineStore('system/UserData', () => {
  const content = useStorage('system/UserData/content', {
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
