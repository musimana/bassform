<script setup>
import AppSectionDivider from '@/Components/Sections/AppSectionDivider.vue'
import InputLabel from '@/Components/Forms/Inputs/InputLabel.vue'
import InputText from '@/Components/Forms/Inputs/InputText.vue'
import InputTextarea from '@/Components/Forms/Inputs/InputTextarea.vue'
import InputWysiwyg from '@/Components/Forms/Inputs/InputWysiwyg.vue'

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
      v-for="(input,inputIndex) in block.schema.inputs"
      :key="inputIndex"
    >
      <InputLabel
        class="block w-full font-medium text-sm mb-2"
        :value="input.label"
      />

      <InputText
        v-if="input.type === 'text'"
        :id="'block-' + index + '-input-text-' + inputIndex"
        class="block w-full mb-4"
        v-model="block.data[input.field]"
      />

      <InputTextarea
        v-else-if="input.type === 'textarea'"
        :id="'block-' + index + '-input-textarea-' + inputIndex"
        class="block w-full"
        v-model="block.data[input.field]"
      />

      <InputWysiwyg
        v-else-if="input.type === 'wysiwyg'"
        :id="'block-' + index + '-input-wysiwyg-' + inputIndex"
        class="block w-full"
        v-model="block.data[input.field]"
      />
    </div>
  </div>
</template>
