<script setup>
import LayoutDefault from '@/Layouts/LayoutDefault.vue'
import ContentHomepage from '@/Pages/Public/Partials/ContentHomepage.vue'

defineProps({
  content: {
    type: Object,
    default: () => ({}),
  },
  metadata: {
    type: Object,
    default: () => ({}),
  },
})
</script>

<template>
  <LayoutDefault>
    <ContentHomepage />
  </LayoutDefault>
</template>
