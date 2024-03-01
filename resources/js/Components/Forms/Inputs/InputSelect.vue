<script setup>
import { onMounted, ref } from 'vue'

defineProps({
  hasNull: {
    type: Boolean,
    default: false,
  },
  modelValue: {},
  options: {
    default: {
      0: { label: 'No', value: 0 },
      1: { label: 'Yes', value: 1 },
    },
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
  <select
    class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 border-gray-900 dark:border-gray-100 focus:ring-gray-900 dark:focus:ring-gray-100 rounded-md shadow-sm dark:shadow-none"
    :value="modelValue"
    @change="$emit('update:modelValue', $event.target.value)"
    ref="input"
  >
    <option :disabled="!hasNull" value="" :class="{ 'hidden' : !hasNull }"><em>none</em></option>

    <option
      v-for="option,index in options"
      :key="index"
      :selected="{'selected': modelValue == option.value}"
      :value="option.value"
    >{{ option.label }}</option>
  </select>
</template>
