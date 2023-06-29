import { ref, reactive } from "vue";
import { defineStore } from "pinia";
import axios from "axios";
import { $Err, $DebugInfo } from '@/helpers/Debug'
import { notify } from 'notiwind'
import { useStorage } from '@vueuse/core'

export const useAuthStore = defineStore("auth/AuthStore", () => {
  $DebugInfo('AuthStore');

  const token = useStorage('auth/AuthStore/token', '');
  const content = useStorage('auth/AuthStore/content', {});
  const config = reactive({
    loading: false,
  })

  // SECTION API
  async function LoginAPI(input) {
    config.loading = true
    try{
      console.log(input)
      let { data: { data }} = await axios.post('/api/login', input)
      content.value = data
      token.value = data.token
      localStorage.setItem('auth', JSON.stringify(data))
      localStorage.setItem('token', JSON.stringify(data.token))

      this.$router.push({ name: 'dashboard'})
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

  async function RecoveryAPI(input) {
    config.loading = true
    try {
      let { data: { data }} = await axios.post('/api/recovery', input)
      config.status = data
    }
    catch(e) {
      $Err('RecoveryAPI Error', {e})
    }
    config.loading = false
  }

  async function ConfirmRecoveryAPI(input) {
    try {
      let { data: { data }} = await axios.post('/api/recovery-confirm', input)
      config.confirm = data
    }
    catch(e) {
      $Err('ConfirmRecoveryAPI Error', {e})
    }
  }

  async function ChangePasswordAPI(input) {
    try {
      let { data: { data }} = await axios.post('/api/change-password-recovery', input)
      if(data) {
        this.$router.push({name: 'login'})
      }
    }
    catch(e) {
      $Err('ChangePasswordAPI Error', {e})
    }
  }

  // SECTION FUNC
  function Logout() {
    content.value = {}
    localStorage.removeItem('auth')
    this.$router.push({ name: 'login'})
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
