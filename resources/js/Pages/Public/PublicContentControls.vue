<script setup>
import LayoutGuest from '@/Layouts/LayoutGuest.vue'
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
  <LayoutGuest>
    <ContentControls />
  </LayoutGuest>
</template>
