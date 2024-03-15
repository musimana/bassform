<script setup>
defineProps({
  customClasses: {
    type: String,
    default: 'w-8 h-8 flex m-auto border focus:border-2 border-gray-900 dark:border-yellow-300 hover:border-gray-600 dark:hover:border-yellow-500 rounded-full',
  },
  type: {
    type: String,
    default: 'button',
  },
})
</script>

<template>
  <button
    :class="customClasses"
    :type="type"
  >
    <slot />
  </button>
</template>
