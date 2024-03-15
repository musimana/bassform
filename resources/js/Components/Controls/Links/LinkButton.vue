<script setup>
import { Link } from '@inertiajs/vue3'
import { computed } from 'vue'

const props = defineProps({
  customClasses: {
    type: String,
    default: 'app-button-primary-gray-900',
  },
  href: {
    type: String,
    required: true,
  },
  minWidth: {
    type: String,
    default: 'lg',
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
  <Link
    class="app-button-base"
    :class="[minWidthClass, customClasses]"
    :href="href"
  >
    <slot />
  </Link>
</template>
