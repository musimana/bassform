<script setup>
import LayoutGuest from '@/Layouts/LayoutGuest.vue'
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
  <LayoutGuest>
    <ContentForms />
  </LayoutGuest>
</template>
