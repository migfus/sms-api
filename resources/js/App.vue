<template>
  <div style="background-color: #F3F4F6;">
    <NotificationsSection />

    <SideNavigation v-if="$route.meta.sideBar"/>
    <TopNavigation v-else/>

  </div>
</template>

<script setup>
import { onMounted } from 'vue'
import { useRoute } from 'vue-router'
import { useJobPublicStore } from '@/store/@public/JobPublicStore'
import { useEventPublicStore } from '@/store/@public/EventPublicStore'
import { useAddressStore } from './store/system/AddressStore'
import { usePostPublicStore } from './store/@public/PostPublicStore'

import { useSalaryTypeStore } from '@/store/system/SalaryTypeStore'
// import { useCivilStatusStore } from '@/store/system/CivilStatusStore'
import { useSeminarTypeStore } from '@/store/system/SeminarTypeStore'
import { useWorkStatusStore } from './store/system/WorkStatusStore'


import NotificationsSection from './components/AppNotifications.vue'
import TopNavigation from '@/layout/TopNavigation.vue'
import SideNavigation from '@/layout/SideNavigation.vue'

const $route = useRoute()
const $job = useJobPublicStore()
const $event = useEventPublicStore()
const $address = useAddressStore()
const $post = usePostPublicStore()

const $salaryType = useSalaryTypeStore()
// const $civilStatus = useCivilStatusStore()
const $seminarType = useSeminarTypeStore()
const $workStatus = useWorkStatusStore()

onMounted(() => {
  $job.GetAPI()
  $event.GetCountAPI()
  $address.GetAPI()
  $post.GetAPI()

  $salaryType.GetAPI()
  // $civilStatus.GetAPI()
  $seminarType.GetAPI()
  $workStatus.GetAPI()
});
</script>
