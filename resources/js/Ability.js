import { defineAbility } from "@casl/ability";
import { useStorage } from '@vueuse/core';
import { toRaw } from 'vue';

export default defineAbility((can, cannot) => {
  const permissions = toRaw(useStorage('permissions', []));

  if(localStorage.getItem('token')) {
    // permissions.map((str) => {
    //   can(str.split(' ')[0], str.split(' ')[1])
    //   return {
    //     str
    //   }
    // })
  }
  else {
    can('show', 'login')
  }

  console.log('localStorage permission update', permissions);
})
