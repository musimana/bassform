<script setup>
import AppButton from '@/Components/Controls/Buttons/AppButton.vue'
import AppForm from '@/Components/Forms/AppForm.vue'
import AppSectionDivider from '@/Components/Sections/AppSectionDivider.vue'
import FormInput from '@/Components/Forms/FormInput.vue'
import InputCheckbox from '@/Components/Forms/Inputs/InputCheckbox.vue'
import InputDate from '@/Components/Forms/Inputs/InputDate.vue'
import InputDatetime from '@/Components/Forms/Inputs/InputDatetime.vue'
import InputError from '@/Components/Forms/Inputs/InputError.vue'
import InputFile from '@/Components/Forms/Inputs/InputFile.vue'
import InputSelect from '@/Components/Forms/Inputs/InputSelect.vue'
import InputSuccess from '@/Components/Forms/Inputs/InputSuccess.vue'
import InputText from '@/Components/Forms/Inputs/InputText.vue'
import InputTextarea from '@/Components/Forms/Inputs/InputTextarea.vue'
import OutlinePaperAirplane from '@/Components/Icons/HeroIcons/Outline/OutlinePaperAirplane.vue'
import { useForm, usePage } from '@inertiajs/vue3'

const form = useForm({
  text: '',
  select: null,
  date: '',
  datetime: '',
  textarea: '',
  pdfUpload: {},
  checkbox: false,
})

</script>

<template>
  <h3 class="w-full py-4 font-semibold text-xs text-gray-950 dark:text-gray-100 uppercase tracking-widest">Form &amp; Input Components</h3>

  <AppForm
    class="w-full"
    :endpoint="route('page.store', 'forms')"
    :form="form"
  >
    <div class="w-full flex pt-4 px-4 bg-gray-300 dark:bg-gray-700">
      <FormInput
        input-label="Text Input*"
        input-label-position="left"
        input-field="text"
        :parent-form="form"
      >
        <InputText
          id="input-text"
          name="text"
          type="text"
          class="block w-full"
          v-model="form.text"
          autofocus
        />
      </FormInput>
    </div>

    <div class="w-full flex pt-4 px-4 bg-gray-300 dark:bg-gray-700">
      <FormInput
        input-label="Select Input*"
        input-label-position="left"
        input-field="select"
        :parent-form="form"
      >
        <InputSelect
          id="input-select"
          class="block w-full"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
          v-model="form.select"
        />
      </FormInput>
    </div>

    <div class="w-full flex pt-4 px-4 bg-gray-300 dark:bg-gray-700">
      <FormInput
        input-label="Date Input"
        input-label-position="left"
        input-field="date"
        :parent-form="form"
      >
        <InputDate
          id="input-date"
          class="block w-full md:w-2/3 lg:w-1/4"
          v-model="form.date"
        />
      </FormInput>
    </div>

    <div class="w-full flex pt-4 px-4 bg-gray-300 dark:bg-gray-700">
      <FormInput
        input-label="Date &amp; Time Input"
        input-label-position="left"
        input-field="datetime"
        :parent-form="form"
        input-help-text="Time in local time"
      >
        <InputDatetime
          id="input-date"
          class="block w-full md:w-2/3 lg:w-1/4"
          v-model="form.datetime"
        />
      </FormInput>
    </div>

    <div class="w-full flex pt-4 px-4 bg-gray-300 dark:bg-gray-700">
      <FormInput
        input-label="Textarea Input"
        input-label-position="left"
        input-field="textarea"
        :parent-form="form"
      >
        <InputTextarea
          id="input-date"
          class="block w-full"
          v-model="form.textarea"
        />
      </FormInput>
    </div>

    <div class="w-full flex p-4 bg-gray-300 dark:bg-gray-700">
      <FormInput
        input-label="PDF Upload Input"
        input-label-position="left"
        input-field="pdfUpload"
        :parent-form="form"
      >
        <InputFile
          class="w-full mt-2"
          input-id="pdfUpload"
          v-model="form.pdfUpload"
        />
      </FormInput>
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
