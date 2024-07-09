<script setup>
import AppBlocks from '@/Components/Blocks/AppBlocks.vue'
</script>

<template>
  <AppBlocks
    v-if="$page.props.content.blocks ?? []"
  />
</template>
