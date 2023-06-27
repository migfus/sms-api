import { watch } from 'vue'
import {
  useWindowFocus,
  useWindowSize,
  useBluetooth,
  usePreferredLanguages,
  useDevicePixelRatio,
  useGeolocation,
} from '@vueuse/core'
import { useUserData } from '@/store/system/UserData';

export default function Data()  {
  const focused = useWindowFocus();
  const $userData = useUserData();

  // NOTE isFocused
  watch(focused, (isFocused) => {
    $userData.content.focusedHistory = [].concat(
      {
        time: Date(),
        isFocused: isFocused,
      }
    );
  });

  $userData.content.windowSize = useWindowSize();

  const { device, requestDevice} = useBluetooth({acceptAllDevices: true});
  requestDevice();
  const { coords } = useGeolocation();

  Object.assign($userData.content, {
    windowSize: useWindowSize(),
    bluetoothDevices: device,
    ...useDevicePixelRatio(),
    preferredLanguage: usePreferredLanguages(),
    coords: coords
  })
}
