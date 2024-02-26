<script setup>
defineProps({
  article: {
    type: String,
    default: '',
  },
  sectionTitle: {
    type: String,
    default: '',
  },
})
</script>

<template>
  <h4 class="w-full mb-6 font-mono text-sm uppercase tracking-widest font-semibold text-gray-950 dark:text-white">++++ {{ sectionTitle }} ++++</h4>

  <article
    v-html="article"
    class="app-challenge-part text-gray-800 dark:text-gray-200 text-sm leading-relaxed"
  ></article>
</template>
