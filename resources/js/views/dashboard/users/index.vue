<template>
  <MenuCard />

  <div v-if="$user.content" class="overflow-hidden bg-white shadow rounded-xl">
    <ul role="list" class="divide-y divide-gray-200">

      <DataTransition>
        <IndividualUser v-for="row in $user.content.data" :data="row" :key="row.id" :toggleOpenAll="$user.toggleOpen"/>
      </DataTransition>

    </ul>
  </div>
  <DeletePrompt />
</template>

<script setup lang="ts">
import { useUserStore } from '@/store/@staff/UserStore'
import { onMounted } from 'vue'

import IndividualUser from './~Components/IndividualUser.vue'
import MenuCard from       './~Components/MenuCard.vue'
import DataTransition from '@/components/transitions/DataTransition.vue'
import DeletePrompt from   './~Components/DeletePrompt.vue'

const $user = useUserStore();


onMounted(() => {
  $user.GetAPI()
})
</script>
