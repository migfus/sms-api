<template>
  <li class="relative">
    <div class="shadow group aspect-square block w-full overflow-hidden rounded-lg bg-gray-100 focus-within:ring-2 focus-within:ring-primary-500 focus-within:ring-offset-2 focus-within:ring-offset-gray-100">
      <img :src="file.url" alt="" class="pointer-events-none object-cover group-hover:opacity-75" />
      <button type="button" class="absolute inset-0 focus:outline-none">
        <span class="sr-only">View details for {{ file.filename }}</span>
      </button>
    </div>

    <div class="flex justify-between">
      <div class="truncate">
        <p class="pointer-events-none mt-2 block text-sm font-medium text-gray-900 truncate">{{ convertFileOrExt(file.filename, false) }}</p>
        <p class="pointer-events-none block text-sm font-medium text-gray-500">.{{ convertFileOrExt(file.filename, true) }}</p>
        <p class="pointer-events-none block text-sm font-medium text-gray-500">{{ formatBytes(file.size) }}</p>
      </div>

      <div class="flex flex-shrink-0 self-center">
        <Menu as="div" class="relative inline-block text-left -right-2">
          <div>
            <MenuButton class="-m-2 flex items-center rounded-full p-2 text-gray-400 hover:text-gray-600">
              <span class="sr-only">Open options</span>
              <EllipsisVerticalIcon class="h-5 w-5 -right-2" aria-hidden="true" />
            </MenuButton>
          </div>

          <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
            <MenuItems class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
              <div class="py-1">
                <!-- <MenuItem v-slot="{ active }">
                  <a href="#" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'flex px-4 py-2 text-sm']">
                    <StarIcon class="mr-3 h-5 w-5 text-gray-400" aria-hidden="true" />
                    <span>Add to favorites</span>
                  </a>
                </MenuItem> -->
                <MenuItem v-slot="{ active }">
                  <a :href="file.url" target="_blank" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'flex px-4 py-2 text-sm']">
                    <CodeBracketIcon class="mr-3 h-5 w-5 text-gray-400" aria-hidden="true" />
                    <span>Download / Link</span>
                  </a>
                </MenuItem>
                <MenuItem v-if="can('removeFile','profile')" v-slot="{ active }">
                  <a @click="$doc.config.deleteID = file.id" href="javascript:void(0)" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'flex px-4 py-2 text-sm']">
                    <XMarkIcon class="mr-3 h-5 w-5 text-gray-400" aria-hidden="true" />
                    <span>Remove</span>
                  </a>
                </MenuItem>
              </div>
            </MenuItems>
          </transition>
        </Menu>
      </div>
    </div>
    <DeletePrompt/>
  </li>

</template>

<script setup lang="ts">
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { CodeBracketIcon, EllipsisVerticalIcon, XMarkIcon, } from '@heroicons/vue/20/solid'
import { formatBytes, convertFileOrExt } from '@/helpers/Converter'
import { toRefs } from 'vue'
import { useDocumentAuthStore } from '@/store/files/DocumentAuthStore'
import { useAbility } from '@casl/vue'

import DeletePrompt from './DeletePrompt.vue'

const $doc = useDocumentAuthStore();
const { can } =  useAbility();
const $props = defineProps<{
  file?: {
    url: string,
    filename: string,
    size: number,
    id: number,
  }
}>()
const { file } = toRefs($props)
</script>
