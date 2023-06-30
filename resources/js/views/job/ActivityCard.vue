<template>
  <section aria-labelledby="section-1-title">
    <h2 class="sr-only" id="section-1-title">Section title</h2>
    <div class="flex justify-end overflow-hidden rounded-lg bg-white shadow">
      <div class="px-6 py-4 text-start">
        <span class="isolate inline-flex rounded-md mt-1">

          <main class="flex-1">
            <div class="">
              <div class="mx-auto max-w">
                <div class="col-span-3">

                  <section aria-labelledby="activity-title" class="">
                    <div>
                      <div class="divide-y divide-gray-200">
                        <div class="pb-4">
                          <h2 id="activity-title" class="text-lg font-medium text-gray-900">Activity/Feedback</h2>
                        </div>
                        <div class="pt-6">
                          <!-- Activity feed-->
                          <div class="flow-root">
                            <ul role="list" class="-mb-8">
                              <li v-for="(item, itemIdx) in activity" :key="item.id">
                                <div class="relative pb-8">
                                  <span v-if="itemIdx !== activity.length - 1" class="absolute top-5 left-5 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true" />
                                  <div class="relative flex items-start space-x-3">
                                    <template v-if="item.type === 'comment'">
                                      <div class="relative">
                                        <img class="flex h-10 w-10 items-center justify-center rounded-full bg-gray-400 ring-8 ring-white" :src="item.imageUrl" alt="" />

                                        <span class="absolute -bottom-0.5 -right-1 rounded-tl px-0.5 py-px">
                                          <ChatBubbleLeftEllipsisIcon class="h-5 w-5 text-primary-400 drop-shadow-sm" aria-hidden="true" />
                                        </span>
                                      </div>
                                      <!-- <div class="min-w-0 flex-1">
                                        <div>
                                          <div class="text-sm">
                                            <a :href="item.person.href" class="font-medium text-gray-900">{{ item.person.name }}</a>
                                          </div>
                                          <p class="mt-0.5 text-sm text-gray-500">Commented {{ item.date }}</p>
                                        </div>
                                        <div class="mt-2 text-sm text-primary-700">
                                          <p>{{ item.comment }}</p>
                                        </div>
                                      </div> -->
                                    </template>
                                    <template v-else-if="item.type === 'assignment'" condition="item.type === 'assignment'">
                                      <div>
                                        <div class="relative px-1">
                                          <div class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-100 ring-8 ring-white">
                                            <DocumentTextIcon class="h-5 w-5 text-gray-500" aria-hidden="true" />
                                          </div>
                                        </div>
                                      </div>
                                      <div class="min-w-0 flex-1 py-1.5">
                                        <div class="text-sm text-gray-500">
                                          <a :href="item.person.href" class="font-medium text-gray-900">{{ item.person.name }}</a>
                                          applied
                                          <a :href="item.assigned.href" class="font-medium text-gray-900">{{ item.assigned.name }}</a>
                                          <span class="whitespace-nowrap">{{ item.date }}</span>
                                        </div>
                                      </div>
                                    </template>
                                    <template v-else>
                                      <div>
                                        <div class="relative px-1">
                                          <div class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-100 ring-8 ring-white">
                                            <TagIcon class="h-5 w-5 text-gray-500" aria-hidden="true" />
                                          </div>
                                        </div>
                                      </div>
                                      <div class="min-w-0 flex-1 py-0">
                                        <div class="text-sm leading-8 text-gray-500">
                                          <span class="mr-0.5">
                                            <a :href="item.person.href" class="font-medium text-gray-900">{{ item.person.name }}</a>
                                            {{ ' ' }}
                                            added tags
                                          </span>
                                          {{ ' ' }}
                                          <span class="mr-0.5">
                                            <template v-for="tag in item.tags" :key="tag.name">
                                              <a :href="tag.href" class="relative inline-flex items-center rounded-full border border-gray-300 px-3 py-0.5 text-sm">
                                                <span class="absolute flex flex-shrink-0 items-center justify-center">
                                                  <span :class="[tag.color, 'h-1.5 w-1.5 rounded-full']" aria-hidden="true" />
                                                </span>
                                                <span class="ml-3.5 font-medium text-gray-900">{{ tag.name }}</span>
                                              </a>
                                              {{ ' ' }}
                                            </template>
                                          </span>
                                          <span class="whitespace-nowrap">{{ item.date }}</span>
                                        </div>
                                      </div>
                                    </template>
                                  </div>
                                </div>
                              </li>
                            </ul>
                          </div>
                          <div class="mt-6">
                            <div class="flex space-x-3">
                              <div class="flex-shrink-0">
                                <div class="relative">
                                  <img class="flex h-10 w-10 items-center justify-center rounded-full bg-gray-400 ring-8 ring-white" src="https://images.unsplash.com/photo-1517365830460-955ce3ccd263?ixlib=rb-=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=8&w=256&h=256&q=80" alt="" />

                                  <span class="absolute -bottom-0.5 -right-1 rounded-tl px-0.5 py-px">
                                    <ChatBubbleLeftEllipsisIcon class="h-5 w-5 text-primary-400 drop-shadow-sm" aria-hidden="true" />
                                  </span>
                                </div>
                              </div>
                              <div class="min-w-0 flex-1">
                                <form action="#">
                                  <div>
                                    <label for="comment" class="sr-only">Comment</label>
                                    <textarea id="comment" name="comment" rows="3" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-300 focus:ring-gray-300 sm:text-sm" placeholder="Leave a comment" />
                                  </div>
                                  <div class="mt-6 flex items-center justify-end space-x-4">
                                    <button type="button" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 focus:z-10 focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500">
                                      <PaperAirplaneIcon class="-ml-1 mr-2 h-5 w-5 text-gray-400" aria-hidden="true" />
                                      Comment
                                    </button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </section>
                </div>
              </div>
            </div>
          </main>

        </span>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
import { ChatBubbleLeftEllipsisIcon, PaperAirplaneIcon, TagIcon, DocumentTextIcon } from '@heroicons/vue/20/solid';

interface activityIn {
  id: number,
  type: string,
  person: {
    name: string,
    href: string,
  },
  assigned: {
    name: string,
    href: string,
  },
  date: string,
  imageUrl: string,
  tags: Array<tagsInt>
}
interface tagsInt {
  href: string,
  color: string,
  name: string,
}

const activity: Array<activityIn> = [
  {
    id: 1,
    type: 'assignment',
    person: { name: 'Hilary Mahy', href: '#' },
    assigned: { name: 'Administrative Something', href: '#' },
    date: '2d ago',
    imageUrl:
      'https://images.unsplash.com/photo-1520785643438-5bf77931f493?ixlib=rb-=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=8&w=256&h=256&q=80',
    tags: [
      {
        name: 'tag 1',
        color: 'black',
        href: 'http://images.unsplash.com/'
      }
    ],
  },
  {
    id: 2,
    type: 'comment',
    person: { name: 'Eduardo Benz', href: '#' },
    assigned: { name: 'Administrative Something', href: '#' },
    imageUrl:
      'https://images.unsplash.com/photo-1520785643438-5bf77931f493?ixlib=rb-=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=8&w=256&h=256&q=80',
    date: '6d ago',
    tags: [
      {
        name: 'tag 2',
        color: 'gray',
        href: 'http://images.unsplash.com/'
      }
    ],
  },
];
</script>
