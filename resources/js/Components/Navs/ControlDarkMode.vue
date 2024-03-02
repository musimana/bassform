<script setup>
import SvgMoon from '@/Components/Images/Svgs/Outline/SvgMoon.vue'
import SvgSun from '@/Components/Images/Svgs/Outline/SvgSun.vue'
import { UseDark } from '@vueuse/components'

defineProps({
  customClasses: {
    type: String,
    default: 'w-8 h-8 flex m-auto border focus:border-2 border-gray-900 dark:border-yellow-300 hover:border-gray-600 dark:hover:border-yellow-500 rounded-full',
  },
})
</script>

<template>
  <UseDark v-slot="{ isDark, toggleDark }">
    <button :class="customClasses" @click="toggleDark()">
      <SvgSun v-if="isDark" class="w-5 h-5 lg:m-auto dark:stroke-yellow-300 dark:hover:stroke-yellow-500" />
      <SvgMoon v-else class="w-4 h-4 lg:m-auto stroke-gray-900 hover:stroke-gray-600" />
    </button>
  </UseDark>
</template>
