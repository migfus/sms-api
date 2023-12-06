<template>
  <div>
    <ProfileBanner />
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
AcademicCapIcon,
  BriefcaseIcon,
  CheckBadgeIcon,
  HandThumbUpIcon,
  PresentationChartLineIcon,
  ScaleIcon,
  UserCircleIcon,
  DevicePhoneMobileIcon,
  FolderIcon
} from '@heroicons/vue/24/outline'

import ProfileBanner from './ProfileBanner.vue'

const $route = useRoute()

const subNavigation = [
  { name: 'Personal Info', href: 'profile', icon: UserCircleIcon, current: true },
  { name: 'Education', href: 'profile-education', icon: AcademicCapIcon, current: false },
  { name: 'Eligibilities', href: 'profile-eligibilities', icon: CheckBadgeIcon, current: false },
  { name: 'Experience', href: 'profile-experience', icon: BriefcaseIcon, current: false },
  { name: 'Voluntaries', href: 'profile-voluntaries', icon: HandThumbUpIcon, current: false },
  { name: 'Seminars', href: 'profile-seminars', icon: PresentationChartLineIcon, current: false },
  { name: 'Skills', href: 'profile-skills', icon: ScaleIcon, current: false },
  { name: 'Mobile Numbers', href: 'profile-mobile', icon: DevicePhoneMobileIcon, current: false },
  { name: 'Uploaded Documents', href: 'profile-documents', icon: FolderIcon, current: false },
]

function ScrollUp() {
  let w = window.innerWidth;

  window.scrollTo({
    top: w < 1024 ? 800 : 0,
    behavior: 'smooth'
  })
}
</script>
