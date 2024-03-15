<script setup>
import { computed } from 'vue'
import { Link } from '@inertiajs/vue3'

const props = defineProps({
  active: {
    type: Boolean,
  },
  href: {
    type: String,
    required: true,
  },
})

const baseClasses = 'w-8 h-8 flex m-auto border focus:border-2 border-gray-900 dark:border-gray-100 hover:border-gray-600 dark:hover:border-gray-300 rounded-full'

const classes = computed(() =>
  props.active
    ? baseClasses + ' fill-blue-500'
    : baseClasses + ' fill-none')

</script>

<template>
  <Link :href="href" :class="classes">
    <slot />
  </Link>
</template>
