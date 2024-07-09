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
  ></section>
</template>
