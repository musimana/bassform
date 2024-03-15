<script setup>
import { computed } from 'vue'

const props = defineProps({
  baseClasses: {
    type: String,
    default: 'app-button-base',
  },
  customClasses: {
    type: String,
    default: 'app-button-primary-gray-900',
  },
  minWidth: {
    type: String,
    default: 'md',
  },
  type: {
    type: String,
    default: 'submit',
  },
})

const minWidthClass = computed(() => {
  return {
    sm: 'min-w-24',
    md: 'min-w-32',
    lg: 'min-w-48',
    xl: 'min-w-64',
  }[props.minWidth]
})

</script>

<template>
  <button
    :class="[baseClasses, minWidthClass, customClasses]"
    :type="type"
  >
    <slot />
  </button>
</template>
