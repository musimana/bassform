<script setup>
import { computed } from 'vue'

const props = defineProps({
  margin: {
    type: String,
    default: 'lg',
  },
})

const marginClass = computed(() => {
  return {
    min: 'my-0',
    sm: 'my-2',
    md: 'my-4',
    lg: 'my-6',
    xl: 'my-8',
    '2xl': 'my-12',
  }[props.margin]
})

</script>

<template>
  <hr
    class="w-full mx-auto border-gray-900 dark:border-gray-100"
    :class="marginClass"
  />
</template>
