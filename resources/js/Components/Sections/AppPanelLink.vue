<script setup>
import SvgArrowRight from '@/Components/Images/Svgs/Outline/SvgArrowRight.vue'

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
    class="relative scale-100 p-8 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-blue-200"
  >
    <section class="w-full">
      <div class="flex w-full mt-8 text-xl font-semibold">
        <h2 class=" text-gray-900 dark:text-white">{{ item.title }}</h2>
      </div>

      <p class="mt-1 text-blue-800 dark:text-blue-200 text-sm leading-relaxed">{{ item.content }}</p>
    </section>

    <SvgArrowRight class="absolute right-0 shrink-0 stroke-white w-6 h-6 mx-8" />
  </a>
</template>
