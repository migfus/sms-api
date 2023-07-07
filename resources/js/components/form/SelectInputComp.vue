<template>
  <select
    v-model="value"
    class="block w-full rounded-md border-gray-300 shadow focus:border-gray-300 focus:ring-gray-300 sm:text-sm"
  >
    <slot>
    </slot>
  </select>
</template>

<script setup lang="ts">
import { toRefs, computed } from 'vue'

const $props = defineProps({
  placeholder:{
    default: '',
    type: String,
  },
  modelValue: {
    default: '',
    type: String,
  }
})
const $emit = defineEmits(['update:modelValue']);

const {
  placeholder,
  modelValue
} = toRefs($props)

const value = computed({
  get() {
    return modelValue.value
  },
  set(val:String) {
    $emit('update:modelValue', val)
  }
})

</script>
