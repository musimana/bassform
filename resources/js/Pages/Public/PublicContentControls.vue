<script setup>
import AppBlocks from '@/Components/Blocks/AppBlocks.vue'
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
    <AppBlocks />

    <ContentControls />
  </LayoutGuest>
</template>
