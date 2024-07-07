<script setup>
import AppSectionDivider from '@/Components/Sections/AppSectionDivider.vue'
import InputLabel from '@/Components/Forms/Inputs/InputLabel.vue'
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
    class="border mb-4 p-4 bg-gray-300 dark:bg-gray-700 border-gray-500 focus:border-gray-100 focus:ring-gray-100 rounded-md shadow-sm dark:shadow-none"
  >
    <InputLabel
      class="block w-full font-medium text-sm"
      :value="block.schema.label"
    />

    <AppSectionDivider margin="md" />

    <div
      v-if="!block.schema.inputs.length && block.data?.html"
      class="opacity-75 cursor-not-allowed"
      v-html="block.data.html"
    ></div>

    <div
      v-else
      class="opacity-75 cursor-not-allowed"
    >{{ block.schema.label }}</div>
  </div>
</template>
