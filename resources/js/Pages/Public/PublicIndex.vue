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
        <SvgCalendarDays class="w-5 h-5 my-auto stroke-blue-800 dark:stroke-blue-200" />

        <h2 v-if="content.heading" class="text-xl font-bold text-blue-950 dark:text-white">{{ content.heading }}</h2>

        <span v-if="content.subheading" class="mx-2 text-blue-800 dark:text-blue-200">|</span>

        <p
          v-if="content.subheading"
          v-html="content.subheading"
          class="mx-2 my-auto text-gray-800 dark:text-gray-200 text-sm leading-relaxed"
        ></p>
      </span>
    </template>

    <div class="w-full pt-12">
      <hr class="max-w-7xl mx-auto border-blue-800 dark:border-blue-200" />
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
