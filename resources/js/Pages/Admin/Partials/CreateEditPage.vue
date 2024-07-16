<script setup>
import AppForm from '@/Components/Forms/AppForm.vue'
import FormInput from '@/Components/Forms/FormInput.vue'
import InputBlocks from '@/Components/Forms/Inputs/InputBlocks.vue'
import InputCheckbox from '@/Components/Forms/Inputs/InputCheckbox.vue'
import InputSelect from '@/Components/Forms/Inputs/InputSelect.vue'
import InputText from '@/Components/Forms/Inputs/InputText.vue'
import AppSectionDivider from '@/Components/Sections/AppSectionDivider.vue'
import TabBody from '@/Components/Controls/Tabs/TabBody.vue'
import TabControls from '@/Components/Controls/Tabs/TabControls.vue'
import CreateEditControls from '@/Pages/Admin/Partials/CreateEditControls.vue'
import { useForm, usePage } from '@inertiajs/vue3'
import { reactive } from 'vue'

const page = usePage().props.content

const form = useForm({
  blocks: page.blocks,
  inSitemap: page.inSitemap,
  metaDescription: page.metaDescription,
  title: page.title,
  webpageStatusId: page.webpageStatusId,
})

const state = reactive({
  showPreviewButton: page.webpageStatusId === 1,
})

</script>

<template>
  <h3 class="w-full p-4 font-semibold text-xs uppercase tracking-widest">Edit Page: {{ page.title }}</h3>

  <AppForm
    class="w-full"
    method="patch"
    :endpoint="route('admin.page.edit', page.id)"
    :form="form"
    @success="state.showPreviewButton = form.webpageStatusId === 1"
  >
    <TabControls
      class="pt-4 px-4"
      :tabs="['Content', 'Meta Data']"
    />

    <AppSectionDivider margin="min" />

    <TabBody
      class="mx-4 pt-4 px-4 bg-white dark:bg-gray-900 rounded-b-md"
      :tab="0"
    >
      <div class="w-full flex pt-4 px-4">
        <FormInput
          input-label="Blocks"
          input-label-position="hidden"
          input-field="blocks"
          :parent-form="form"
        >
          <InputBlocks
            :blocks="form.blocks"
          />
        </FormInput>
      </div>
    </TabBody>

    <TabBody
      class="mx-4 px-4 py-8 bg-white dark:bg-gray-900 rounded-b-md"
      :tab="1"
    >
      <div class="w-full flex pt-2 px-4">
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

      <div class="w-full flex pt-2 px-4">
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

      <div class="w-full flex pt-2 px-4">
        <FormInput
          input-label="Webpage Status"
          input-label-position="left"
          input-field="webpageStatusId"
          :parent-form="form"
        >
          <InputSelect
            id="input-webpage-status-id"
            name="webpageStatusId"
            class="block w-full"
            v-model="form.webpageStatusId"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
            :options="{
              0: { label: 'Draft', value: 1 },
              1: { label: 'Published', value: 2 },
            }"
          />
        </FormInput>
      </div>

      <div class="w-full flex pt-2 px-4">
        <label class="flex items-start text-sm">
          <InputCheckbox class="my-auto" name="inSitemap" v-model:checked="form.inSitemap" />

          <span class="ms-2 text-gray-700 dark:text-gray-300">In Sitemap?</span>
        </label>
      </div>
    </TabBody>

    <CreateEditControls
      :parent-form="form"
      :show-preview-button="state.showPreviewButton"
      :url-preview-url="route('admin.page.show', page.id)"
      :url-return="route('dashboard')"
      :url-view="route('page.show', page.slug)"
    />
  </AppForm>
</template>
