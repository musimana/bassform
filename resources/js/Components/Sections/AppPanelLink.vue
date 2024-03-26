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
    class="relative grid grid-cols-1 scale-100 border-2 border-gray-400 dark:border-gray-200 p-8 bg-blue-800 bg-gradient-to-bl from-blue-300/80 via-blue-600 ring-1 ring-inset ring-gray-100/5 rounded-lg motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-blue-600 dark:focus:outline-gray-200"
  >
    <h3 class="text-gray-200 text-xl font-semibold">{{ item.title }}</h3>

    <p class="mt-8 text-gray-200 text-sm leading-relaxed">{{ item.content }}</p>

    <slot />

    <OutlineArrowRight class="absolute right-0 shrink-0 stroke-gray-100 w-6 h-6 m-8" />
  </a>
</template>
