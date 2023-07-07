<template>
  <MenuCard />

  <div v-if="$user.content" class="overflow-hidden bg-white shadow rounded-xl">
    <ul role="list" class="divide-y divide-gray-200">

      <IndividualUser v-for="row in $user.content.data" :data="row"/>

    </ul>
  </div>
</template>

<script setup>
import { useUserStore } from '@/store/users/UserStore'
import { onMounted } from 'vue'

import IndividualUser from './IndividualUser.vue'
import MenuCard from './MenuCard.vue'

const $user = useUserStore();

onMounted(() => {
  $user.GetAPI()
});
</script>
