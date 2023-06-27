<template>
  <div class="">
    <div class="bg-white my-5 mx-auto max-w-7xl py-4 sm:px-6 px-8 sm:rounded-3xl shadow">
      <FullCalendar :options='calendarOptions' >
        <template v-slot:eventContent='arg'>
          <b>{{ arg.event.title }}</b>
        </template>
      </FullCalendar>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'

const calendarOptions = ref({
  plugins: [dayGridPlugin],
  initialView: 'dayGridMonth',
  events: [
    {
      "title": "Event",
      "start": "2023-06-17T09:00:00",
      "end": "2023-06-17T18:00:00",
      'display':'block',
      'backgroundColor': '#FCD34D',
      'textColor': '#000',
      'borderColor': '#FCD34D'
    },
    {
      "title": "Event2",
      "start": "2023-06-18T09:00:00",
      "end": "2023-06-18T18:00:00",
      'display':'block',
      'backgroundColor': '#16A34A',
      'textColor': '#eee',
      'borderColor': '#16A34A'
    },
  ],
});
</script>
