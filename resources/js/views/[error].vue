<template>
  <main class="bg-cover bg-center sm:bg-top" style="background-image: url('https://images.unsplash.com/photo-1545972154-9bb223aac798?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=3050&q=80&exp=8&con=-15&sat=-75')">
    <div class="mx-auto max-w-7xl py-16 px-6 text-center sm:py-24 lg:px-8 lg:py-48">
      <p class="text-base font-semibold text-white">404</p>
      <h1 class="mt-2 text-4xl font-bold tracking-tight text-white sm:text-5xl">Uh oh! I think you’re lost.</h1>
      <p class="mt-2 text-lg font-medium text-white">It looks like the page you’re looking for doesn't exist.</p>
      <div class="mt-6">
        <RouterLink :to="{ name: 'home'}" class="inline-flex items-center">
          <AppButton color="white">Go Back Home</AppButton>
        </RouterLink>
      </div>
    </div>
  </main>
</template>

<script setup lang="ts">
import AppButton from '@/components/form/AppButton.vue';
</script>
