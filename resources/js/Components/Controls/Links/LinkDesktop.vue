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

const baseClasses = 'inline-flex items-center px-1 border-b-2 text-sm font-semibold leading-5 focus:outline focus:outline-4 focus:rounded-sm focus:outline-blue-200 transition duration-150 ease-in-out'

const classes = computed(() =>
  props.active
    ? baseClasses + ' border-blue-900 dark:border-gray-100 text-blue-950 dark:text-gray-100'
    : baseClasses + ' border-transparent text-gray-900 hover:text-gray-600 dark:text-gray-100 dark:hover:text-gray-300 hover:border-gray-500 dark:hover:border-gray-300')

</script>

<template>
  <Link :href="href" :class="classes">
    <slot />
  </Link>
</template>
