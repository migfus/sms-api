import { useStorage } from '@vueuse/core'
import { defineStore } from 'pinia'

interface contentInt {
  focusedHistory: Array<String>
  windowSize: {
    height: Number,
    width: Number,
  },
  bluetoothDevices: Array<String>,
  preferredLanguage: Array<String>,
  pixelRatio: Number,
  coords: {
    altitude: Number,
    longitude: Number,
  },
}

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
