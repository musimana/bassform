<script setup>
import IconAppLogo from '@/Components/Icons/IconAppLogo.vue'
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
  <LayoutGuest>
    <ContentHomepage />
  </LayoutGuest>
</template>
