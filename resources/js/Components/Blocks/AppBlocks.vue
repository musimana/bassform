<script setup>
import AppSectionHtml from '@/Components/Sections/AppSectionHtml.vue'
import BlockHeaderLogo from '@/Components/Blocks/BlockHeaderLogo.vue'
import BlockPanelLinks from '@/Components/Blocks/BlockPanelLinks.vue'
import BlockTabs from '@/Components/Blocks/BlockTabs.vue'
import AppSectionDivider from '@/Components/Sections/AppSectionDivider.vue'
</script>

<template>
  <div v-for="(block,index) in $page.props.content.blocks" :key="index">
    <BlockHeaderLogo
      v-if="block?.type === 'header-logo'"
      :block-data="block.data"
      :id="'header-' + index"
    />

    <BlockPanelLinks
      v-else-if="block?.type === 'panel-links'"
      :id="'panel-links-' + index"
      :items="block.data.items"
      :title="block.data.title"
    />

    <BlockTabs
      v-else-if="block?.type === 'tabs'"
      :block-data="block.data"
      :id="'tabs-' + index"
    />

    <AppSectionDivider v-else-if="block?.type === 'section-divider'" />

    <AppSectionHtml
      v-else
      :html="block.data.html"
      class="app-article px-4 pb-8 leading-relaxed"
      :id="'section-' + index"
    ></AppSectionHtml>
  </div>
</template>
