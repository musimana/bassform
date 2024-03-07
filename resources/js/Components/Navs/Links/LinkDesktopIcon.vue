<script setup>
import { Link } from '@inertiajs/vue3'

const props = defineProps({
  href: {
    type: String,
    required: true,
  },
  active: {
    type: Boolean,
  },
})

const baseClasses = 'w-8 h-8 flex m-auto border focus:border-2 border-gray-900 dark:border-gray-100 hover:border-gray-600 dark:hover:border-gray-300 rounded-full'

</script>

<template>
  <Link :href="href" :class="baseClasses">
    <slot />
  </Link>
</template>
