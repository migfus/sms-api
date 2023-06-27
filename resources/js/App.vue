<template>
  <div style="background-color: #F3F4F6;">
    <NotificationsSection />


    <SideNavigation v-if="$route.meta.sideBar"/>
    <TopNavigation v-else/>

    <FooterLayout />
  </div>
</template>

<script setup>
import { onMounted } from 'vue';
import { useRoute } from 'vue-router';
import Data from '@/Data'
import { useJobPublicStore } from '@/store/job/JobPublicStore';
Data();

import NotificationsSection from './components/Notifications.vue';
import TopNavigation from '@/layout/TopNavigation.vue';
import SideNavigation from '@/layout/SideNavigation.vue';
import FooterLayout from '@/layout/Footer.vue';

const $route = useRoute();
const $job = useJobPublicStore();

onMounted(() => {
  $job.GetAPI()
});
</script>
