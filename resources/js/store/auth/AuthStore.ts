import { ref, reactive } from "vue";
import { defineStore } from "pinia";
import axios from "axios";
import { $Err, $DebugInfo } from '@/helpers/Debug'
import { notify } from 'notiwind'
import { useStorage } from '@vueuse/core'

interface contentInt {
  permissions: Array<string>;
}
interface configInt {
  loading: boolean;
  status: string;
  confirm: string;
}
interface InputInt {
  email: string;
  password: string;
}

export const useAuthStore = defineStore("auth/AuthStore", () => {
  $DebugInfo('AuthStore');

  const token = useStorage<String>('auth/AuthStore/token', '');
  const content = useStorage<contentInt>('auth/AuthStore/content', null);
  const config = reactive<configInt>({
    loading: false,
    status: '',
    confirm: '',
  })

  // SECTION API
  async function LoginAPI(input: InputInt) {
    config.loading = true
    try{
      console.log(input)
      let { data: { data }} = await axios.post('/api/login', input)
      content.value = data
      token.value = data.token
      localStorage.setItem('auth', JSON.stringify(data))
      localStorage.setItem('token', JSON.stringify(data.token))
      //@ts-ignore
      this.router.push({ name: 'dashboard'})
    }
    catch(e) {
      if(e.response.data.message != 'Invalid Input') {
        notify({
          group: "error",
          title: "Invalid Credentials",
          text: 'Mistyped? Please try again.'
        }, 5000)
      }
    }
    config.loading = false
  }

  async function RecoveryAPI(input: InputInt) {
    config.loading = true
    try {
      let { data: { data }} = await axios.post('/api/recovery', input)
      config.status = data
    }
    catch(e) {
      $Err('RecoveryAPI Error', '')
    }
    config.loading = false
  }

  async function ConfirmRecoveryAPI(input: InputInt) {
    try {
      let { data: { data }} = await axios.post('/api/recovery-confirm', input)
      config.confirm = data
    }
    catch(e) {
      $Err('ConfirmRecoveryAPI Error', '')
    }
  }

  async function ChangePasswordAPI(input: InputInt) {
    try {
      let { data: { data }} = await axios.post('/api/change-password-recovery', input)
      if(data) {
        //@ts-ignore
        this.router.push({name: 'login'})
      }
    }
    catch(e) {
      $Err('ChangePasswordAPI Error', '')
    }
  }

  // SECTION FUNC
  function Logout() {
    content.value = null
    localStorage.removeItem('auth')
    //@ts-ignore
    this.router.push({ name: 'login'})
  }

  function UpdateLocalStorage() {
    localStorage.setItem('auth', JSON.stringify(content.value))
  }

  return {
    content,
    config,
    token,

    UpdateLocalStorage,
    ConfirmRecoveryAPI,
    ChangePasswordAPI,
    LoginAPI,
    RecoveryAPI,
    Logout,
  }
});
