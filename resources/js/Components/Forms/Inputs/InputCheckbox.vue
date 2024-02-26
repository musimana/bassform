<script setup>
import { computed } from 'vue'

const emit = defineEmits(['update:checked'])

const props = defineProps({
  checked: {
    type: [Array, Boolean],
    required: true,
  },
  value: {
    default: null,
  },
})

const proxyChecked = computed({
  get() {
    return props.checked
  },

  set(val) {
    emit('update:checked', val)
  },
})

</script>

<template>
  <input
    type="checkbox"
    :value="value"
    v-model="proxyChecked"
    class="rounded bg-white dark:bg-gray-900 border-gray-500 text-blue-200 focus:ring-blue-200 shadow-sm dark:shadow-none"
  />
</template>
