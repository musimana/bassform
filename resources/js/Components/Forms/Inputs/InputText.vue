<script setup>
import { onMounted, ref } from 'vue'

defineProps({
  modelValue: {
    type: String,
    required: true,
  },
})

defineEmits(['update:modelValue'])

const input = ref(null)

onMounted(() => {
  if (input.value.hasAttribute('autofocus')) {
    input.value.focus()
  }
})

defineExpose({ focus: () => input.value.focus() })
</script>

<template>
  <input
    class="bg-white dark:bg-gray-900 text-gray-900 dark:text-white border-gray-500 focus:border-blue-200 focus:ring-blue-200 rounded-md shadow-sm dark:shadow-none"
    :value="modelValue"
    @input="$emit('update:modelValue', $event.target.value)"
    ref="input"
  />
</template>
