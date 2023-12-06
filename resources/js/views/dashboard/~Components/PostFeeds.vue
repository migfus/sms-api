<template>
  <ul role="list" class="divide-y divide-gray-200 mt-4 sm:rounded-xl shadow bg-white">
    <h1 class="p-4 font-bold text-gray-500">Latest Posts</h1>
    <li v-for="row in $post.content" :key="row.id" class="relative  py-5 px-4 focus-within:ring-2 focus-within:ring-inset focus-within:ring-primary-600 hover:bg-gray-50">
      <div class="flex justify-between space-x-3">
        <div class="min-w-0 flex-1">
          <RouterLink :to="'/posts/' + row.id" class="block focus:outline-none">
            <span class="absolute inset-0" aria-hidden="true" />
            <p class="truncate text-sm font-medium text-gray-900"><img :src="row.user.avatar" class="h-6 inline"/> <span>{{ row.user.email }}</span></p>
            <p class="truncate text-sm text-gray-500 font-medium">{{ row.title }}</p>
          </RouterLink>
        </div>
        <time :datetime="row.created_at" class="flex-shrink-0 whitespace-nowrap text-sm text-gray-500">{{ moment(row.created_at).fromNow(true) }}</time>
      </div>
      <div class="mt-1">
        <p class="text-sm text-gray-600 line-clamp-2">{{ row.content }}</p>
      </div>
    </li>
  </ul>
</template>

<script setup lang="ts">
import { usePostPublicStore } from '@/store/@public/PostPublicStore'
import moment from 'moment'

const $post = usePostPublicStore()
</script>
