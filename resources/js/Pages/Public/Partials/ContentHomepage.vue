<script setup>
import AppPanelLink from '@/Components/Sections/AppPanelLink.vue'
import AppSectionDivider from '@/Components/Sections/AppSectionDivider.vue'
import AppSectionHtml from '@/Components/Sections/AppSectionHtml.vue'
</script>

<template>
  <AppSectionDivider margin="xl" />

  <AppSectionHtml
    v-if="$page.props.content.bodytext !== ''"
    :html="$page.props.content.bodytext"
    class="px-4"
  />

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
