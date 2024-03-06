<script setup>
import OutlineArrowRight from '@/Components/Icons/HeroIcons/Outline/OutlineArrowRight.vue'

defineProps({
  item: {
    type: Object,
    required: true,
  },
})
</script>

<template>
  <a
    :href="item.url"
    class="relative scale-100 border-2 border-gray-700 dark:border-gray-300 p-8 bg-blue-50 dark:bg-blue-900/50 bg-gradient-to-tl dark:bg-gradient-to-bl from-blue-300/30 via-transparent dark:ring-1 dark:ring-inset dark:ring-gray-100/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-gray-700 dark:focus:outline-gray-300"
  >
    <section class="w-full">
      <div class="flex w-full text-xl font-semibold">
        <h2 class="text-gray-800 dark:text-gray-300 text-xl font-semibold">{{ item.title }}</h2>
      </div>

      <p class="mt-8 text-gray-700 dark:text-gray-300 text-sm leading-relaxed">{{ item.content }}</p>
    </section>

    <OutlineArrowRight class="absolute right-0 shrink-0 stroke-gray-700 dark:stroke-gray-100 w-6 h-6 mx-8" />
  </a>
</template>
