<template>
  <div style="background-color: #F3F4F6;">
    <NotificationsSection />

    <SideNavigation v-if="$route.meta.sideBar"/>
    <TopNavigation v-else/>

  </div>
</template>

<script setup>
import NotificationsSection from './components/AppNotifications.vue'
import TopNavigation from        '@/layout/TopNavigation.vue'
import SideNavigation from       '@/layout/SideNavigation.vue'
</script>
