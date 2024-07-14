<script setup>
import InputError from '@/Components/Forms/Inputs/InputError.vue'
import InputHelpText from '@/Components/Forms/Inputs/InputHelpText.vue'
import InputLabel from '@/Components/Forms/Inputs/InputLabel.vue'
import { computed } from 'vue'

const props = defineProps({
  inputErrorClasses: {
    type: String,
    default: 'w-full min-h-6',
  },
  inputField: {
    type: String,
    required: true,
  },
  inputHelpText: {
    type: String,
    required: false,
  },
  inputLabel: {
    type: String,
    required: true,
  },
  inputLabelPosition: {
    type: String,
    default: 'top',
  },
  inputSlotClasses: {
    type: String,
    default: 'w-full',
  },
  parentForm: {
    type: Object,
    required: true,
  },
})

const labelPositionClasses = computed(() => {
  return {
    top: 'w-full text-gray-700 dark:text-gray-300',
    left: 'my-3 w-full md:w-1/3 text-gray-700 dark:text-gray-300',
    hidden: 'sr-only',
  }[props.inputLabelPosition]
})

</script>

<template>
  <InputLabel
    :for="inputField"
    :value="inputLabel"
    :class="labelPositionClasses"
  />

  <div :class="inputSlotClasses">
    <slot />

    <InputHelpText
      v-if="inputHelpText"
      :class="inputErrorClasses"
      :message="inputHelpText"
    />

    <InputError
      :class="inputErrorClasses"
      :message="parentForm.errors[inputField]"
    />
  </div>
</template>
