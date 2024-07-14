<script setup>
import IconAppLogo from '@/Components/Icons/IconAppLogo.vue'

defineProps({
  blockData: {
    type: Object,
    required: true,
  },
})
</script>

<template>
  <div class="flex justify-center gap-x-4 mt-4">
    <IconAppLogo class="w-12 h-12 stroke-current fill-current" />

    <h2 class="my-auto text-center text-xl font-bold">{{ blockData.heading }}</h2>
  </div>

  <p
    v-if="blockData.subheading !== ''"
    class="w-full text-center pt-8 font-semibold text-xs text-gray-600 dark:text-gray-400 uppercase tracking-wide"
  >
    {{ blockData.subheading }}
  </p>
</template>
