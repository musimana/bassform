<script setup>
import { onMounted, ref } from 'vue'

const model = defineModel({
  type: String,
  required: true,
})

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
    class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 border-gray-500 focus:border-gray-100 focus:ring-gray-100 rounded-md shadow-sm dark:shadow-none"
    v-model="model"
    ref="input"
    type="date"
  />
</template>
