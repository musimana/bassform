<script setup>
import AppHead from '@/Components/Sections/AppHead.vue'
import LayoutGuest from '@/Layouts/LayoutGuest.vue'
import ContentHomepage from '@/Pages/Public/Partials/ContentHomepage.vue'

defineProps({
  content: {
    type: Object,
    default: () => ({}),
  },
  metadata: {
    type: Object,
    default: () => ({}),
  },
})
</script>

<template>
  <AppHead :metadata="metadata" />

  <LayoutGuest>
    <template #pageHeader>
      <h2 class="text-center text-xl font-bold text-gray-800 dark:text-gray-300">{{ $page.props.content.heading }}</h2>
    </template>

    <ContentHomepage />
  </LayoutGuest>
</template>
