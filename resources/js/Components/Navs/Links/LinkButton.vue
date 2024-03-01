<script setup>
import { Link } from '@inertiajs/vue3'

const props = defineProps({
  customClasses: {
    type: String,
    default: 'app-button-primary-gray-900',
  },
  href: {
    type: String,
    required: true,
  },
})

</script>

<template>
  <Link
    class="app-button-base"
    :class="customClasses"
    :href="href"
  >
    <slot />
  </Link>
</template>
