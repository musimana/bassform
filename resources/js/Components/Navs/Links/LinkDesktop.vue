<script setup>
import { computed } from 'vue'
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

const classes = computed(() =>
  props.active
    ? 'inline-flex items-center px-1 pt-1 border-b-2 border-gray-900 dark:border-white text-sm font-semibold leading-5 text-gray-900 dark:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-blue-200 transition duration-150 ease-in-out'
    : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-semibold leading-5 text-gray-800 hover:text-gray-950 dark:text-gray-200 dark:hover:text-gray-50 hover:border-gray-950 dark:hover:border-gray-50 focus:outline focus:outline-2 focus:rounded-sm focus:outline-blue-200 transition duration-150 ease-in-out')

</script>

<template>
  <Link :href="href" :class="classes">
    <slot />
  </Link>
</template>
