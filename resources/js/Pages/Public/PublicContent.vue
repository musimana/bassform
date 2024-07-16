<script setup>
import AppBlocks from '@/Components/Blocks/AppBlocks.vue'
import LayoutGuest from '@/Layouts/LayoutGuest.vue'

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
  </LayoutGuest>
</template>
