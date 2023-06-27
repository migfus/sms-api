<template>
  <div>
    <HomePage v-if="$preLoader.config.to == 'home'"/>
    <AboutPage v-if="$preLoader.config.to == 'about'"/>
    <ContactPage v-if="$preLoader.config.to == 'contact'"/>
    <AuthPage v-if="
      $preLoader.config.to == 'login' ||
      $preLoader.config.to == 'forgot' ||
      $preLoader.config.to == 'register'
    "/>
    <JobListingPage v-if="$preLoader.config.to == 'job-listing'"/>
    <CalendarPage v-if="$preLoader.config.to == 'calendar'"/>
    <FAQPage v-if="$preLoader.config.to == 'faqs'"/>
  </div>
</template>

<script setup>
import { usePreLoader } from '@/store/system/PreLoader'

import HomePage from './HomePage.vue';
import AboutPage from './AboutPage.vue';
import ContactPage from './ContactPage.vue';
import AuthPage from './AuthPage.vue';
import JobListingPage from './JobListingPage.vue';
import CalendarPage from './CalendarPage.vue';
import FAQPage from './FAQPage.vue';

const $preLoader = usePreLoader();
</script>
