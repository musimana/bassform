<script setup>
import AppPanelLink from '@/Components/Sections/AppPanelLink.vue'
</script>

<template>
  <section
    v-if="$page.props.content?.items.length"
    class="w-full mb-8 px-4 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8"
  >
  <AppPanelLink
      v-for="(item,index) in $page.props.content?.items"
      :key="index"
      :item="item"
    />
  </section>

  <section
    v-else
    class="w-full mb-8 px-4 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8"
  >
    <em class="block text-center text-gray-600 dark:text-gray-400">No results found.</em>
  </section>
</template>
