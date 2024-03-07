<script setup>
import AppPanelLink from '@/Components/Sections/AppPanelLink.vue'
</script>

<template>
  <div class="w-full pb-8">
    <hr class="max-w-7xl mx-auto border-gray-700 dark:border-gray-300" />
  </div>

  <article
    v-html="$page.props.content.bodytext"
    class="text-gray-600 dark:text-gray-300"
  ></article>

  <div class="w-full mb-8">
    <div
      v-if="$page.props.content?.items.length"
      class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8"
    >
      <AppPanelLink
        v-for="(item,index) in $page.props.content?.items"
        :key="index"
        :item="item"
      />
    </div>
    <em v-else class="block text-center text-gray-600 dark:text-gray-400">No results found.</em>
  </div>
</template>
