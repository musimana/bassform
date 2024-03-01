<script setup>
defineProps({
  customClasses: {
    type: String,
    default: 'app-button-primary-gray-900',
  },
  type: {
    type: String,
    default: 'submit',
  },
})
</script>

<template>
  <button
    :type="type"
    class="app-button-base"
    :class="customClasses"
  >
    <slot />
  </button>
</template>
