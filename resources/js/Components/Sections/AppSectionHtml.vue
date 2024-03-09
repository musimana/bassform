<script setup>
defineProps({
  html: {
    type: String,
    default: '',
  },
})
</script>

<template>
  <section
    v-html="html"
    class="app-article text-gray-600 dark:text-gray-200 text-sm leading-relaxed"
  ></section>
</template>
