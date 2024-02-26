<script setup>
import AppHead from '@/Components/Sections/AppHead.vue'
import AppPanel from '@/Components/Sections/AppPanel.vue'
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
    <AppPanel>
      <ContentHomepage />
    </AppPanel>
  </LayoutGuest>
</template>
