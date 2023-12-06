<template>
  <div class="grid grid-cols-12 gap-4">
    <div class="col-span-12 xl:col-span-8">
      <!-- <StatisticCard class=""/> -->
      <AppliedJob />
      <ProfileSummary />
    </div>
    <div class="col-span-12 xl:col-span-4">
      <ActivityFeeds class=""/>
      <PostsFeeds />
    </div>
  </div>
</template>

<script setup lang="ts">
import ActivityFeeds from './~Components/ActivityFeeds.vue'
import StatisticCard from './~Components/StatisticCard.vue'
import PostsFeeds from    './~Components/PostFeeds.vue'
import AppliedJob from    './~Components/AppliedJob.vue'
import ProfileSummary from'./~Components/ProfileSummary.vue'
</script>
