<script setup>
import AppSectionHtml from '@/Components/Sections/AppSectionHtml.vue'
import BlockTabs from '@/Components/Blocks/BlockTabs.vue'
</script>

<template>
  <div v-for="(block,index) in $page.props.content.blocks" :key="index">
    <BlockTabs
      v-if="(block,index) in $page.props.content.blocks"
      :block-data="block.data"
      :id="'block-' + index"
      class="px-4 pb-12 text-sm text-gray-900 dark:text-gray-100"
    />

    <AppSectionHtml
      v-else
      :html="block.data.html"
      :id="'block-' + index"
      class="px-4 pb-12 text-sm text-gray-900 dark:text-gray-100"
    ></AppSectionHtml>
  </div>
</template>
