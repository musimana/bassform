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
    ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-grey-900 dark:border-gray-100 text-start text-base font-semibold text-gray-900 dark:text-gray-100 bg-gray-200 dark:bg-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-gray-100'
    : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-semibold text-gray-600 hover:text-gray-600 dark:text-gray-400 dark:hover:text-gray-200 hover:border-gray-600 dark:hover:border-gray-200 focus:outline focus:outline-2 focus:rounded-sm focus:outline-gray-100 transition duration-150 ease-in-out')

</script>

<template>
  <Link :href="href" :class="classes">
    <slot />
  </Link>
</template>
