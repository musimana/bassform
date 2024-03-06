<script setup>
import LayoutDefault from '@/Layouts/LayoutDefault.vue'

defineProps({
  content: {
    type: Object,
    required: true,
  },
  metadata: {
    type: Object,
    required: true,
  },
})
</script>

<template>
  <LayoutDefault>
    <div
      v-if="content.addendum !== ''"
      v-html="content.addendum"
      class="px-4 pb-12 text-sm text-gray-900 dark:text-gray-100"
    ></div>
  </LayoutDefault>
</template>
