<script setup>
import AppHead from '@/Components/Sections/AppHead.vue'
import AppPanel from '@/Components/Sections/AppPanel.vue'
import LayoutGuest from '@/Layouts/LayoutGuest.vue'

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
  <AppHead :metadata="metadata" />

  <LayoutGuest>
    <template #pageHeader>
      <h2 class="font-semibold text-md text-gray-900 dark:text-white uppercase tracking-widest">{{ content.title }}</h2>

      <h3 class="pt-2 font-semibold text-xs text-blue-800 dark:text-blue-200 uppercase tracking-widest">
        <em>{{ content.subtitle }}</em>
      </h3>
    </template>

    <AppPanel>
      <div class="w-full pt-4">
        <article
          v-html="content.article"
          :id="content.title.replace(' ', '-').toLowerCase()"
          class="app-challenge-part text-gray-800 dark:text-gray-200 text-sm leading-relaxed"
        ></article>
      </div>

      <div
        v-if="content.addendum !== ''"
        v-html="content.addendum"
        class="px-4 pb-12 text-sm text-blue-800 dark:text-blue-200"
      ></div>
    </AppPanel>
  </LayoutGuest>
</template>
