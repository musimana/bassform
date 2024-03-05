<script setup>
import LayoutDefault from '@/Layouts/LayoutDefault.vue'
import ContentForms from '@/Pages/Public/Partials/ContentForms.vue'

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
    <ContentForms />
  </LayoutDefault>
</template>
