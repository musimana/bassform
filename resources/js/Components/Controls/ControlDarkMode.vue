<script setup>
import ButtonIcon from '@/Components/Controls/Buttons/ButtonIcon.vue'
import OutlineMoon from '@/Components/Icons/HeroIcons/Outline/OutlineMoon.vue'
import OutlineSun from '@/Components/Icons/HeroIcons/Outline/OutlineSun.vue'
import { UseDark } from '@vueuse/components'

defineProps({
  customClasses: {
    type: String,
    default: 'w-8 h-8 flex border border-gray-900 dark:border-yellow-300 hover:border-gray-600 dark:hover:border-yellow-500 rounded-full text-gray-900 hover:text-gray-600 dark:text-yellow-300 dark:hover:text-yellow-500',
  },
})
</script>

<template>
  <UseDark v-slot="{ isDark, toggleDark }">
    <ButtonIcon
      :custom-classes="customClasses"
      @click="toggleDark()"
    >
      <OutlineSun v-if="isDark" class="w-5 h-5 m-auto" />
      <OutlineMoon v-else class="w-4 h-4 m-auto" />
    </ButtonIcon>
  </UseDark>
</template>
