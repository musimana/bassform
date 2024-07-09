<script setup>
import AppPanelLink from '@/Components/Sections/AppPanelLink.vue'

defineProps({
  items: {
    type: Array,
    required: true,
  },
  title: {
    type: String,
    default: '',
  },
})
</script>

<template>
  <section class="mb-8">
    <h3
      v-if="title !== ''"
      class="font-semibold mb-4 px-4 text-gray-800 dark:text-gray-300"
    >{{ title }}</h3>

    <div
      v-if="items.length"
      class="w-full mb-8 px-4 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8"
    >
      <AppPanelLink
        v-for="(item,index) in items"
        :key="index"
        :item="item"
      />
    </div>

    <div v-else>
      <em class="block text-center text-gray-600 dark:text-gray-400">No results found.</em>
    </div>
  </section>
</template>
