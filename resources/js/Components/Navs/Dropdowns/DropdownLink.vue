<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
  href: {
    type: String,
    required: true,
  },
})
</script>

<template>
  <Link
    :href="href"
    class="block w-full px-4 py-2 text-sm font-semibold leading-5 text-gray-600 dark:text-gray-100 hover:text-gray-900 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 transition duration-150 ease-in-out"
  >
    <slot />
  </Link>
</template>
