<template>
  <div style="background-color: #F3F4F6;">
    <NotificationsSection />


    <SideNavigation v-if="$route.meta.sideBar"/>
    <TopNavigation v-else/>


  </div>
</template>

<script setup>
import { onMounted } from 'vue';
import { useRoute } from 'vue-router';
import Data from '@/Data'
import { useJobPublicStore } from '@/store/job/JobPublicStore';
import { useEventPublicStore } from '@/store/event/EventPublicStore';
Data();
import { useAddressStore } from './store/system/AddressStore';

import NotificationsSection from './components/Notifications.vue';
import TopNavigation from '@/layout/TopNavigation.vue';
import SideNavigation from '@/layout/SideNavigation.vue';


const $route = useRoute();
const $job = useJobPublicStore();
const $event = useEventPublicStore();
const $address = useAddressStore();

onMounted(() => {
  $job.GetAPI()
  $event.GetCountAPI()
  $address.GetAPI()
});
</script>
