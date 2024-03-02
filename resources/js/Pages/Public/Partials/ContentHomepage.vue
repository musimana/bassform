<script setup>
import InputError from '@/Components/Forms/Inputs/InputError.vue'
import InputFile from '@/Components/Forms/Inputs/InputFile.vue'
import InputLabel from '@/Components/Forms/Inputs/InputLabel.vue'
import InputSuccess from '@/Components/Forms/Inputs/InputSuccess.vue'
import AppButton from '@/Components/Navs/Buttons/AppButton.vue'
import { useForm, usePage } from '@inertiajs/vue3'

const form = useForm({
  pdfUpload: {},
})

const submit = () => {
  form.post(route('textract.store'), {
    preserveScroll: true,
    onSuccess: () => form.reset(),
  })
}

</script>

<template>
  <h1 class="text-center text-xl font-bold text-gray-600 dark:text-gray-300">{{ $page.props.metadata.appName }}</h1>

  <hr class="my-8" />

  <article
    v-html="$page.props.content.bodytext"
    class="mb-8 text-md text-gray-600 dark:text-gray-400"
  ></article>

  <form @submit.prevent="submit" class="w-full">
    <div class="w-full flex p-4 bg-gray-300 dark:bg-gray-700">
      <InputLabel class="my-auto w-full md:w-1/5 text-gray-600 dark:text-gray-400" for="pdfUpload" value="Select Files:" />

      <InputFile
        input-id="pdfUpload"
        v-model="form.pdfUpload"
      />
    </div>

    <div class="w-full flex pt-4 justify-between">
      <span class="flex mt-4">
        <InputError class="my-auto" :message="form.errors.pdfUpload" />
        <InputSuccess class="my-auto" :message="usePage().props.flash.status" />
      </span>

      <span class="w-1/2 h-8 mt-4 py-1">
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
        custom-classes="app-button-primary-gray-900 mt-4"
        :class="{ 'opacity-25': form.processing }"
        :disabled="form.processing"
      >Upload</AppButton>
    </div>
  </form>

  <hr class="my-8" />

  <h2 class="text-lg font-bold text-gray-600 dark:text-gray-300">Results:</h2>

  <div class="w-full flex mt-8 p-4 bg-gray-300 dark:bg-gray-700">
    <code v-if="usePage().props.flash.output" class="text-gray-600 dark:text-gray-400">{{ usePage().props.flash.output }}</code>
    <p v-else class="text-gray-600 dark:text-gray-400">[ <em>The response from the form will appear here.</em> ]</p>
  </div>
</template>
