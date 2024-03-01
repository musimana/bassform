<script setup>
import AppHead from '@/Components/Sections/AppHead.vue'
// import AppPanelLink from '@/Components/Sections/AppPanelLink.vue'
import SvgCalendarDays from '@/Components/Images/Svgs/Outline/SvgCalendarDays.vue'
import LayoutGuest from '@/Layouts/LayoutGuest.vue'

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
      <span class="flex gap-2">
        <SvgCalendarDays class="w-5 h-5 my-auto stroke-gray-900 dark:stroke-gray-100" />

        <h2 v-if="content.heading" class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ content.heading }}</h2>

        <span v-if="content.subheading" class="mx-2 text-gray-900 dark:text-gray-100">|</span>

        <p
          v-if="content.subheading"
          v-html="content.subheading"
          class="mx-2 my-auto text-gray-600 dark:text-gray-200 text-sm leading-relaxed"
        ></p>
      </span>
    </template>

    <div class="w-full pt-12">
      <hr class="max-w-7xl mx-auto border-gray-900 dark:border-gray-100" />
    </div>

    <div class="w-full pt-12">
      <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
        <!-- <AppPanelLink
          v-for="item,index in content.items"
          :key="index"
          :item="item"
        /> -->
      </div>
    </div>
  </LayoutGuest>
</template>
