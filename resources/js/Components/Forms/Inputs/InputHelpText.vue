<script setup>
defineProps(['message'])
</script>

<template>
  <div v-show="message">
    <p class="block w-full pt-1 text-sm text-gray-900 dark:text-gray-100">
      <em>{{ message }}</em>
    </p>
  </div>
</template>
