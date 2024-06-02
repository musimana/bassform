<script setup>
const props = defineProps({
  blocks: {
    type: Object,
    default: () => ({}),
  },
})

</script>

<template>
  <div
    v-for="(block,index) in props.blocks"
    :key="index"
    class="flex border mb-4 p-4 bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 border-gray-500 focus:border-gray-100 focus:ring-gray-100 rounded-md shadow-sm dark:shadow-none"
  >
    <div
      v-if="block.type === 'stack'"
      class="opacity-75 cursor-not-allowed"
      v-html="block.data.html"
    ></div>

    <div
      v-else
      class="opacity-75 cursor-not-allowed"
    >Static Block</div>
  </div>
</template>
