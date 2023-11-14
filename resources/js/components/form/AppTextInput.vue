<template>
  <input
    v-model="value"
    :placeholder="placeholder"
    :type="type"
    :name="name" :id="name"
    class="block w-full rounded-lg border-gray-300 focus:border-gray-300 ring-gray-300 focus:ring-gray-300 shadow focus:shadow-none sm:text-sm"
  />
</template>

<script setup lang="ts">
  import { toRefs, computed } from 'vue'

  const $props = defineProps({
    placeholder:{
      default: '',
      type: String,
    },
    type: {
      default: 'text',
      type: String,
    },
    name: {
      default: 'button-',
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
    type,
    name,
    modelValue,
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
