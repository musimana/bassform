<script setup>
import AppBlocks from '@/Components/Blocks/AppBlocks.vue'
import AppSectionDivider from '@/Components/Sections/AppSectionDivider.vue'
import AppSectionHtml from '@/Components/Sections/AppSectionHtml.vue'
</script>

<template>
  <AppSectionDivider margin="xl" />

  <AppSectionHtml
    v-if="$page.props.content.bodytext !== ''"
    :html="$page.props.content.bodytext"
    class="mb-12 px-4"
  />

  <AppBlocks
    v-if="$page.props.content.blocks ?? []"
  />
</template>
