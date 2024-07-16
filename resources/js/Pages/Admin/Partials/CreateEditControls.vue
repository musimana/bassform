<script setup>
import AppButton from '@/Components/Controls/Buttons/AppButton.vue'
import InputError from '@/Components/Forms/Inputs/InputError.vue'
import InputSuccess from '@/Components/Forms/Inputs/InputSuccess.vue'
import LinkButton from '@/Components/Controls/Links/LinkButton.vue'
import OutlineArrowTopRightOnSquare from '@/Components/Icons/HeroIcons/Outline/OutlineArrowTopRightOnSquare.vue'
import OutlineArrowUturnLeft from '@/Components/Icons/HeroIcons/Outline/OutlineArrowUturnLeft.vue'
import OutlinePaperAirplane from '@/Components/Icons/HeroIcons/Outline/OutlinePaperAirplane.vue'
import { usePage } from '@inertiajs/vue3'

defineProps({
  parentForm: {
    type: Object,
    required: true,
  },
  showPreviewButton: {
    type: Boolean,
    default: false,
  },
  urlPreview: {
    type: String,
    default: '',
  },
  urlReturn: {
    type: String,
    default: '',
  },
  urlView: {
    type: String,
    default: '',
  },
})
</script>

<template>
  <div class="w-full flex mt-4 pt-4 px-4">
    <span class="w-full sm:w-1/2 xl:w-1/4 min-h-8">
      <InputError class="my-2" :message="parentForm.hasErrors ? 'Please update the indicated fields' : ''" />

      <InputSuccess :message="usePage().props.flash.status" />
    </span>

    <span class="w-full sm:w-1/2 xl:w-1/4 h-8 my-auto py-1">
      <progress
        v-if="parentForm.progress"
        class="w-full my-auto"
        max="100"
        :value="parentForm.progress.percentage"
      >
        {{ parentForm.progress.percentage }}%
      </progress>
    </span>

    <span class="sm:flex w-full xl:w-1/2 justify-end space-y-2 sm:space-y-0 sm:space-x-2 my-auto">
      <LinkButton
        v-if="urlReturn !== ''"
        custom-classes="app-button-secondary-gray-100"
        :href="returnUrl"
        min-width="md"
      >
        Cancel <OutlineArrowUturnLeft class="ml-2 h-4 w-4" />
      </LinkButton>

      <LinkButton
        v-show="urlPreview !== '' && showPreviewButton"
        custom-classes="app-button-secondary-gray-100"
        :href="previewUrl"
        min-width="md"
        title="Preview the draft page"
        target="_blank"
        rel="noopener noreferrer"
      >
        Preview <OutlineArrowTopRightOnSquare class="-mt-0.5 -mr-0.5 ml-2 h-4 w-4" />
      </LinkButton>

      <LinkButton
        v-show="urlView !== '' && !showPreviewButton"
        custom-classes="app-button-secondary-gray-100"
        :href="viewUrl"
        min-width="md"
        title="View the page"
        target="_blank"
        rel="noopener noreferrer"
      >
        View <OutlineArrowTopRightOnSquare class="-mt-0.5 -mr-0.5 ml-2 h-4 w-4" />
      </LinkButton>

      <AppButton
        :class="{ 'opacity-25': parentForm.processing }"
        :disabled="parentForm.processing"
        min-width="md"
      >
        Save <OutlinePaperAirplane class="ml-2 h-4 w-4" />
      </AppButton>
    </span>
  </div>
</template>
