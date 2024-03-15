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

const baseClasses = 'flex w-full ps-3 pe-4 py-2 border-l-4 text-start text-base font-semibold focus:outline focus:outline focus:rounded-sm focus:outline-gray-900 dark:focus:outline-gray-100 transition duration-150 ease-in-out'

const classes = computed(() =>
  props.active
    ? baseClasses + ' border-gray-900 dark:border-gray-100 text-gray-900 dark:text-gray-100 bg-gray-300 dark:bg-gray-900'
    : baseClasses + ' border-transparent text-gray-900 hover:text-gray-600 dark:text-gray-200 dark:hover:text-gray-400 hover:border-gray-600 dark:hover:border-gray-200')

</script>

<template>
  <Link :href="href" :class="classes">
    <slot />
  </Link>
</template>
