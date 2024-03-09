<script setup>
import AppSectionDivider from '@/Components/Sections/AppSectionDivider.vue'
import AppSectionHtml from '@/Components/Sections/AppSectionHtml.vue'
import BlockIndexPanels from '@/Components/Blocks/BlockIndexPanels.vue'
</script>

<template>
  <AppSectionDivider margin="xl" />

  <AppSectionHtml
    v-if="$page.props.content.bodytext !== ''"
    :html="$page.props.content.bodytext"
    class="px-4"
  />

  <BlockIndexPanels />
</template>
