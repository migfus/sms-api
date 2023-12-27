<template>

  <Disclosure as="nav" class="bg-white shadow" v-slot="{ open }">
    <HeaderBanner />
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
      <div class="relative flex h-16 justify-between">
        <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
          <!-- Mobile menu button -->
          <DisclosureButton class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary-500">
            <span class="sr-only">Open main menu</span>
            <Bars3Icon v-if="!open" class="block h-6 w-6" aria-hidden="true" />
            <XMarkIcon v-else class="block h-6 w-6" aria-hidden="true" />
          </DisclosureButton>
          <object class="block h-10 w-auto lg:hidden" data="/images/logo.svg" alt="Your Company" />
        </div>
        <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
          <div class="flex flex-shrink-0 items-center">
            <object class="hidden h-10 w-auto sm:block sm:ml-5" data="/images/logo.svg" alt="Your Company" />
            <!-- <object class="block h-10 w-auto lg:hidden" data="/images/logo.svg" alt="Your Company" /> -->
            <span class="ml-3 font-semibold lg:block hidden xs:block">OHRM | CMU CSC-ID</span>
          </div>
          <div class="hidden sm:ml-6 sm:flex sm:space-x-8">

            <RouterLink to="/"
              :class="[$route.name == 'register' ? 'border-primary-700 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700',
                'inline-flex items-center border-b-2 px-1 pt-1 text-sm font-medium'
                ]"
            >
              Register
            </RouterLink>

          </div>
        </div>


        <ProfileDropdown />

      </div>
    </div>

    <DisclosurePanel class="sm:hidden">
      <div class="space-y-1 pt-2 pb-4">

        <RouterLink
            v-for="row in $nav.pages"
            :key="`${row.name}`"
            :to="{name: row.link.name }"
            @click="open"
            :class="[row.link.name == $route.name ?
              'block border-l-4 border-primary-500 bg-primary-50 py-2 pl-3 pr-4 text-base font-medium text-primary-700' :
              'block border-l-4 border-transparent py-2 pl-3 pr-4 text-base font-medium text-gray-500 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-700',
              'flex-nowrap']
            ">
            <DisclosureButton style="width: 100%; text-align: left;">
              {{ row.name }}
            </DisclosureButton>

        </RouterLink>

      </div>
    </DisclosurePanel>
  </Disclosure>

  <PreLoader v-if="$preLoader.config.loading"/>
  <RouterView v-else></RouterView>

  <FooterLayout />
</template>

<script setup lang='ts'>
import { Disclosure, DisclosureButton, DisclosurePanel, Popover, PopoverPanel, PopoverButton } from '@headlessui/vue'
import { Bars3Icon, XMarkIcon, ChevronDownIcon } from '@heroicons/vue/24/outline'
import { useNavigationStore } from '@/store/system/NavigationStore'
import { useRoute } from 'vue-router'
import { usePreLoader } from '@/store/system/PreLoader'

import HeaderBanner from '@/layout/HeaderBanner.vue'
import PreLoader from '@/layout/preloader/@PreLoader.vue'
import ProfileDropdown from './ProfileDropdown.vue'
import FooterLayout from './Footer.vue'

const $nav = useNavigationStore()
const $route = useRoute()
const $preLoader = usePreLoader()
</script>
