<script setup>
import AppButton from '@/Components/Controls/Buttons/AppButton.vue'
import AppForm from '@/Components/Forms/AppForm.vue'
import FormInput from '@/Components/Forms/FormInput.vue'
import InputCheckbox from '@/Components/Forms/Inputs/InputCheckbox.vue'
import InputError from '@/Components/Forms/Inputs/InputError.vue'
import InputSuccess from '@/Components/Forms/Inputs/InputSuccess.vue'
import InputText from '@/Components/Forms/Inputs/InputText.vue'
import OutlinePaperAirplane from '@/Components/Icons/HeroIcons/Outline/OutlinePaperAirplane.vue'
import { useForm, usePage } from '@inertiajs/vue3'

const page = usePage().props.content

const form = useForm({
  inSitemap: page.inSitemap,
  metaDescription: page.metaDescription,
  metaTitle: page.metaTitle,
  subtitle: page.subtitle,
  title: page.title,
})

</script>

<template>
  <h3 class="w-full py-4 font-semibold text-xs text-gray-950 dark:text-gray-100 uppercase tracking-widest">Edit Page: {{ page.title }}</h3>

  <AppForm
    class="w-full"
    :endpoint="route('page.store', 'forms')"
    :form="form"
  >
    <div class="w-full flex pt-4 px-4">
      <FormInput
        input-label="Title*"
        input-label-position="left"
        input-field="text"
        :parent-form="form"
      >
        <InputText
          id="input-title"
          name="text"
          type="text"
          class="block w-full"
          v-model="form.title"
          autofocus
        />
      </FormInput>
    </div>

    <div class="w-full flex pt-4 px-4">
      <FormInput
        input-label="Subtitle"
        input-label-position="left"
        input-field="text"
        :parent-form="form"
      >
        <InputText
          id="input-subtitle"
          name="text"
          type="text"
          class="block w-full"
          v-model="form.subtitle"
        />
      </FormInput>
    </div>

    <div class="w-full flex pt-4 px-4">
      <FormInput
        input-label="Meta Title"
        input-label-position="left"
        input-field="text"
        :parent-form="form"
      >
        <InputText
          id="input-meta-title"
          name="text"
          type="text"
          class="block w-full"
          v-model="form.metaTitle"
        />
      </FormInput>
    </div>

    <div class="w-full flex pt-4 px-4">
      <FormInput
        input-label="Meta Description"
        input-label-position="left"
        input-field="text"
        :parent-form="form"
      >
        <InputText
          id="input-meta-description"
          name="text"
          type="text"
          class="block w-full"
          v-model="form.metaDescription"
        />
      </FormInput>
    </div>

    <div class="w-full flex p-4">
      <label class="flex items-start">
        <InputCheckbox name="checkbox" v-model:checked="form.inSitemap" />

        <span class="ms-2 text-sm text-gray-700 dark:text-gray-300">In Sitemap?</span>
      </label>
    </div>

    <div class="w-full flex mt-4 pt-4 justify-between">
      <span class="flex mt-4">
        <InputError class="my-auto" :message="form.hasErrors ? 'Please update the indicated fields' : ''" />

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
        Save <OutlinePaperAirplane class="ml-2 h-4 w-4" />
      </AppButton>
    </div>
  </AppForm>
</template>
