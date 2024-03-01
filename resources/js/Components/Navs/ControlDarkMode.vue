<script setup>
import SvgMoon from '@/Components/Images/Svgs/Outline/SvgMoon.vue'
import SvgSun from '@/Components/Images/Svgs/Outline/SvgSun.vue'
import { UseDark } from '@vueuse/components'

defineProps({
  customClasses: {
    type: String,
    default: 'w-6 h-6 flex m-auto',
  },
})
</script>

<template>
  <UseDark v-slot="{ isDark, toggleDark }">
    <span :class="customClasses" @click="toggleDark()">
      <SvgSun v-if="isDark" class="w-5 h-5 lg:m-auto dark:stroke-yellow-300" />
      <SvgMoon v-else class="w-4 h-4 lg:m-auto stroke-blue-800" />
    </span>
  </UseDark>
</template>
