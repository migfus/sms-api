<template>
  <div>
    <main class="relative">
      <div class="mx-auto max-w-screen-xl pb-6">
        <div class="overflow-hidden">
          <div class="lg:grid lg:grid-cols-12 gap-3">
            <aside class="py-6 lg:col-span-3 sm:rounded-xl bg-white shadow mb-2">
              <nav class="space-y-1">
                <RouterLink v-for="item in subNavigation" :key="item.name" :to="{name: item.href}" @click="ScrollUp()" :class="[item.href == $route.name ? 'bg-teal-50 border-teal-500 text-teal-700 hover:bg-teal-50 hover:text-teal-700' : 'border-transparent text-gray-900 hover:bg-gray-50 hover:text-gray-900', 'group border-l-4 px-3 py-2 flex items-center text-sm font-medium']" :aria-current="item.current ? 'page' : undefined">
                  <component :is="item.icon" :class="[item.href == $route.name ? 'text-teal-500 group-hover:text-teal-500' : 'text-gray-400 group-hover:text-gray-500', 'flex-shrink-0 -ml-1 mr-3 h-6 w-6']" aria-hidden="true" />
                  <span class="truncate">{{ item.name }}</span>
                </RouterLink>
              </nav>
            </aside>

            <slot></slot>


          </div>
        </div>
      </div>
    </main>
  </div>
</template>

<script setup lang="ts">
import {useRoute} from 'vue-router'
import {
  UserCircleIcon,
  LockClosedIcon,
} from '@heroicons/vue/24/outline'

const $route = useRoute()

const subNavigation = [
  { name: 'General Settings', href: 'account', icon: UserCircleIcon, current: true },
  { name: 'Update Password', href: 'account-password', icon: LockClosedIcon, current: true },
]

function ScrollUp() {
  window.scrollTo({
    top: 0, behavior: 'smooth'
  })
}
</script>
