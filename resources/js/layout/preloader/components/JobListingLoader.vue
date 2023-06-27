<template>
  <div class="drop-shadow-sm bg-zinc-100">

    <div class="mx-auto max-w-7xl py-4 lg:px-8">
      <div class="grid grid-cols-1 lg:grid-cols-3 items-start gap-4">

        <!-- NOTE TOP -->
        <div class="overflow-hidden bg-white shadow sm:rounded-lg col-span-3">
          <div class="px-4 py-5 sm:px-6">
            <div class="
              -translate-x-full
              animate-[shimmer_2s_infinite]
              relative
              before:absolute
              before:inset-0 before:-translate-x-full
              before:animate-[shimmer_2s_infinite]
              before:bg-gradient-to-r
              isolate
              overflow-hidden
              shadow-xl shadow-primary-700/20
              -top-11
              "
            >
              &nbsp;
            </div>

            <div class="block hover:bg-gray-50 animate-pulse">

              <div class="px-4 pb-3 sm:px-6">
                <div class="sm:flex sm:justify-between">
                  <div class="sm:flex">
                    <p class="flex items-center text-sm text-gray-500">
                      <div class="w-32 h-6 bg-gray-300 rounded-full"></div>
                    </p>
                  </div>
                  <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                    <div class="w-32 h-6 bg-gray-300 rounded-full"></div>
                  </div>
                </div>

              </div>
            </div>

          </div>
        </div>

        <!-- NOTE LEFT -->
        <div class="overflow-hidden bg-white shadow sm:rounded-lg col-span-3 lg:col-span-1">
          <div class="px-4 py-5 sm:px-6">
            <div class="
              -translate-x-full
              animate-[shimmer_2s_infinite]
              relative
              before:absolute
              before:inset-0 before:-translate-x-full
              before:animate-[shimmer_2s_infinite]
              before:bg-gradient-to-r
              isolate
              overflow-hidden
              shadow-xl shadow-primary-700/20
              -top-11
              "
            >
              &nbsp;
            </div>

            <div class="block hover:bg-gray-50 animate-pulse">

              <div class="px-4 pb-3 sm:px-6">
                <p class="flex items-center text-sm text-gray-500">
                  <div class="w-full h-6 bg-gray-300 rounded-full mb-2"></div>
                </p>
                <p class="flex items-center text-sm text-gray-500">
                  <div class="w-9/12 h-6 bg-gray-300 rounded-full"></div>
                </p>

                <p class="flex items-center text-sm text-gray-500">
                  <div class="w-5/12 h-4 bg-gray-300 rounded-full mb-2 mt-4"></div>
                </p>
                <p class="flex items-center text-sm text-gray-500">
                  <div class="w-11/12 h-4 bg-gray-300 rounded-full"></div>
                </p>
                <p class="flex items-center text-sm text-gray-500">
                  <div class="w-8/12 h-4 bg-gray-300 rounded-full mb-2 mt-4"></div>
                </p>
                <p class="flex items-center text-sm text-gray-500">
                  <div class="w-5/12 h-4 bg-gray-300 rounded-full"></div>
                </p>
              </div>
            </div>

          </div>
        </div>

        <!-- NOTE RIGHT (CONTENT)  -->
        <div class="overflow-hidden bg-white shadow sm:rounded-lg col-span-3 lg:col-span-2">
          <div class="overflow-hidden bg-white shadow sm:rounded-md">
            <ul role="list" class="divide-y divide-gray-200">

              <li v-for="position in content" :key="position.id">
                <div class="
                  -translate-x-full
                  animate-[shimmer_2s_infinite]
                  relative
                  before:absolute
                  before:inset-0 before:-translate-x-full
                  before:animate-[shimmer_2s_infinite]
                  before:bg-gradient-to-r
                  isolate
                  overflow-hidden
                  shadow-xl shadow-primary-700/20
                  -top-6
                  z-50
                "
                >
                  &nbsp;
                </div>
                <div class="block hover:bg-gray-50 animate-pulse">

                  <div class="px-4 py-4 sm:px-6">
                    <div class="flex items-center justify-between">
                      <div class="w-24 h-4 bg-gray-300 rounded-full"></div>
                      <div class="ml-2 flex flex-shrink-0">
                        <div class="w-12 h-4 bg-gray-200 rounded-full mr-2"></div>
                        <div class="w-12 h-4 bg-gray-200 rounded-full"></div>
                      </div>
                    </div>

                    <div class="mt-2 sm:flex sm:justify-between">
                      <div class="sm:flex">
                        <p class="flex items-center text-sm text-gray-500">
                          <div class="w-4 h-4 bg-gray-200 rounded-full mr-2"></div>
                          <div class="w-24 h-4 bg-gray-200 rounded-full"></div>
                        </p>
                        <p class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0 sm:ml-6">
                          <div class="w-4 h-4 bg-gray-200 rounded-full mr-2"></div>
                          <div class="w-24 h-4 bg-gray-200 rounded-full"></div>
                        </p>
                      </div>
                      <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                        <div class="w-4 h-4 bg-gray-200 rounded-full mr-2"></div>
                        <div class="w-24 h-4 bg-gray-200 rounded-full"></div>
                      </div>
                    </div>

                  </div>
                </div>
              </li>

            </ul>
          </div>
        </div>

      </div>
    </div>

  </div>
</template>

<script setup>
import { ref } from 'vue'


const content = ref([1]);
let maxCount = 2;

let interval = setInterval(() => {
  content.value.push(1);

  if(maxCount < content.value.length) {
    clearInterval(interval);
  }
}, 30);
</script>

