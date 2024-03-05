<script setup>
import LayoutDefault from '@/Layouts/LayoutDefault.vue'
import ContentControls from '@/Pages/Public/Partials/ContentControls.vue'

defineProps({
  content: {
    type: Object,
    required: true,
  },
  metadata: {
    type: Object,
    required: true,
  },
})
</script>

<template>
  <LayoutDefault>
    <ContentControls />
  </LayoutDefault>
</template>
