<script setup>
import AppButton from '@/Components/Controls/Buttons/AppButton.vue'
import AppForm from '@/Components/Forms/AppForm.vue'
import AppSectionDivider from '@/Components/Sections/AppSectionDivider.vue'
import InputCheckbox from '@/Components/Forms/Inputs/InputCheckbox.vue'
import InputError from '@/Components/Forms/Inputs/InputError.vue'
import InputFile from '@/Components/Forms/Inputs/InputFile.vue'
import InputLabel from '@/Components/Forms/Inputs/InputLabel.vue'
import InputSelect from '@/Components/Forms/Inputs/InputSelect.vue'
import InputSuccess from '@/Components/Forms/Inputs/InputSuccess.vue'
import InputText from '@/Components/Forms/Inputs/InputText.vue'
import OutlinePaperAirplane from '@/Components/Icons/HeroIcons/Outline/OutlinePaperAirplane.vue'
import { usePage } from '@inertiajs/vue3'
import { reactive } from 'vue'

const form = reactive({
  text: '',
  select: null,
  checkbox: false,
  pdfUpload: {},
  errors: {},
})

</script>

<template>
  <h3 class="w-full py-4 font-semibold text-xs text-gray-950 dark:text-gray-100 uppercase tracking-widest">Form &amp; Input Components</h3>

  <AppForm
    class="w-full"
    :endpoint="route('page.store', 'forms')"
    :form="form"
  >
    <div class="w-full flex p-4 bg-gray-300 dark:bg-gray-700">
      <InputLabel
        class="my-auto w-full md:w-1/3 text-gray-700 dark:text-gray-300"
        for="text"
        value="Text Input"
      />

      <InputText
        id="input-text"
        name="text"
        type="text"
        class="mt-1 block w-full md:w-2/3"
        v-model="form.text"
        required
        autofocus
      />

      <InputError class="mt-2" :message="form.errors.text" />
    </div>

    <div class="w-full flex p-4 bg-gray-300 dark:bg-gray-700">
      <InputLabel
        class="my-auto w-full md:w-1/3 text-gray-700 dark:text-gray-300"
        for="select"
        value="Select Input"
      />

      <InputSelect
        id="input-select"
        :class="{ 'opacity-25': form.processing }"
        :disabled="form.processing"
        :model-value="form.select"
        @update:modelValue="form.select = $event"
      />

      <InputError class="mt-2" :message="form.errors.select" />
    </div>

    <div class="w-full flex p-4 bg-gray-300 dark:bg-gray-700">
      <InputLabel
        class="my-auto w-full md:w-1/3 text-gray-700 dark:text-gray-300"
        for="pdfUpload"
        value="PDF Upload Input"
      />

      <InputFile
        class="w-full md:w-2/3"
        input-id="pdfUpload"
        v-model="form.pdfUpload"
      />
    </div>

    <div class="w-full flex p-4">
      <label class="flex items-start">
        <InputCheckbox name="checkbox" v-model:checked="form.checkbox" />

        <span class="ms-2 text-sm text-gray-700 dark:text-gray-300">Checkbox Input</span>
      </label>
    </div>

    <div class="w-full flex mt-4 pt-4 justify-between">
      <span class="flex mt-4">
        <InputError class="my-auto" :message="form.errors.pdfUpload" />
        <InputSuccess class="my-auto" :message="usePage().props.flash.status" />
      </span>

      <span class="w-1/2 h-8 my-auto py-1">
        <progress
          v-if="form.progress"
          class="w-full my-auto"
          max="100"
          :value="form.progress.percentage"
        >
          {{ form.progress.percentage }}%
        </progress>
      </span>

      <AppButton
        :class="{ 'opacity-25': form.processing }"
        :disabled="form.processing"
      >
        Send <OutlinePaperAirplane class="ml-2 h-4 w-4" />
      </AppButton>
    </div>
  </AppForm>

  <AppSectionDivider margin="xl" />

  <h3 class="mb-4 text-lg font-bold text-gray-600 dark:text-gray-300">Results:</h3>

  <div class="w-full flex p-4 bg-gray-300 dark:bg-gray-700">
    <code v-if="usePage().props.flash.output" class="text-gray-600 dark:text-gray-400">{{ usePage().props.flash.output }}</code>
    <p v-else class="text-gray-600 dark:text-gray-400">[ <em>The response from the form will appear here.</em> ]</p>
  </div>
</template>
