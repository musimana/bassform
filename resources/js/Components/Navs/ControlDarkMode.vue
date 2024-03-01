<script setup>
import SvgMoon from '@/Components/Images/Svgs/Outline/SvgMoon.vue'
import SvgSun from '@/Components/Images/Svgs/Outline/SvgSun.vue'
import { UseDark } from '@vueuse/components'

defineProps({
  customClasses: {
    type: String,
    default: 'w-8 h-8 flex m-auto border border-gray-900 dark:border-yellow-300 hover:border-gray-600 hover:dark:border-yellow-500 rounded-full cursor-pointer',
  },
})
</script>

<template>
  <UseDark v-slot="{ isDark, toggleDark }">
    <span :class="customClasses" @click="toggleDark()">
      <SvgSun v-if="isDark" class="w-5 h-5 lg:m-auto dark:stroke-yellow-300 hover:dark:stroke-yellow-500" />
      <SvgMoon v-else class="w-4 h-4 lg:m-auto stroke-gray-900 hover:stroke-gray-600" />
    </span>
  </UseDark>
</template>
