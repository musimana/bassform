<script setup>
import AppBlocks from '@/Components/Blocks/AppBlocks.vue'
import LayoutDefault from '@/Layouts/LayoutDefault.vue'

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
    <AppBlocks />
  </LayoutDefault>
</template>
