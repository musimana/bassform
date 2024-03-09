<script setup>
import AppSectionHtml from '@/Components/Sections/AppSectionHtml.vue'
</script>

<template>
  <AppSectionHtml
    v-for="(block,index) in $page.props.content.blocks"
    :key="index"
    :html="block.html"
    :id="'block-' + index"
    class="px-4 pb-12 text-sm text-gray-900 dark:text-gray-100"
  ></AppSectionHtml>
</template>
