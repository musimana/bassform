<script setup>
import AppForm from '@/Components/Forms/AppForm.vue'
import FormInput from '@/Components/Forms/FormInput.vue'
import InputBlocks from '@/Components/Forms/Inputs/InputBlocks.vue'
import InputCheckbox from '@/Components/Forms/Inputs/InputCheckbox.vue'
import InputText from '@/Components/Forms/Inputs/InputText.vue'
import CreateEditControls from '@/Pages/Admin/Partials/CreateEditControls.vue'
import { useForm, usePage } from '@inertiajs/vue3'

const page = usePage().props.content

const form = useForm({
  blocks: page.blocks,
  inSitemap: page.inSitemap,
  metaDescription: page.metaDescription,
  title: page.title,
})

</script>

<template>
  <h3 class="w-full py-4 font-semibold text-xs text-gray-950 dark:text-gray-100 uppercase tracking-widest">Edit Page: {{ page.title }}</h3>

  <AppForm
    class="w-full"
    method="patch"
    :endpoint="route('admin.page.edit', page.id)"
    :form="form"
  >
    <div class="w-full flex pt-4 px-4">
      <FormInput
        input-label="Title*"
        input-label-position="left"
        input-field="title"
        :parent-form="form"
      >
        <InputText
          id="input-title"
          name="title"
          type="text"
          class="block w-full"
          v-model="form.title"
          autofocus
        />
      </FormInput>
    </div>

    <div class="w-full flex pt-4 px-4">
      <FormInput
        input-label="Blocks"
        input-label-position="left"
        input-field="blocks"
        :parent-form="form"
      >
        <InputBlocks
          :blocks="form.blocks"
        />
      </FormInput>
    </div>

    <div class="w-full flex pt-4 px-4">
      <FormInput
        input-label="Meta Description"
        input-label-position="left"
        input-field="metaDescription"
        :parent-form="form"
      >
        <InputText
          id="input-meta-description"
          name="metaDescription"
          type="text"
          class="block w-full"
          v-model="form.metaDescription"
        />
      </FormInput>
    </div>

    <div class="w-full flex p-4">
      <label class="flex items-start">
        <InputCheckbox class="my-auto" name="inSitemap" v-model:checked="form.inSitemap" />

        <span class="ms-2 text-gray-700 dark:text-gray-300">In Sitemap?</span>
      </label>
    </div>

    <CreateEditControls
      :parent-form="form"
      :url-return="route('dashboard')"
    />
  </AppForm>
</template>
