<script setup>
import AppSectionHtml from '@/Components/Sections/AppSectionHtml.vue'
import BlockPanelLinks from '@/Components/Blocks/BlockPanelLinks.vue'
import BlockTabs from '@/Components/Blocks/BlockTabs.vue'
</script>

<template>
  <div v-for="(block,index) in $page.props.content.blocks" :key="index">
    <BlockPanelLinks
      v-if="block?.type === 'panel-links'"
      :id="'panel-links-' + index"
      :items="block.data.items"
      :title="block.data.title"
    />

    <BlockTabs
      v-else-if="block?.type === 'tabs'"
      :block-data="block.data"
      :id="'block-' + index"
    />

    <AppSectionHtml
      v-else
      :html="block.data.html"
      :id="'block-' + index"
      class="px-4 pb-12 text-sm text-gray-900 dark:text-gray-100"
    ></AppSectionHtml>
  </div>
</template>
