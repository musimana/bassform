<script setup>
import CKEditor from '@ckeditor/ckeditor5-vue'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic'

const model = defineModel({
  type: String,
  required: true,
})

const editorConfig = {}

</script>

<template>
  <div class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 border-gray-500 focus:border-gray-100 focus:ring-gray-100 rounded-md shadow-sm dark:shadow-none">
    <CKEditor.component
      :editor="ClassicEditor"
      v-model="model"
      :config="editorConfig"
    ></CKEditor.component>
  </div>
</template>

<style>
.ck-powered-by-balloon {
  display: none !important;
}

.ck-editor__main * {
  background-color: transparent !important;
  color: var(--tw-current-color) !important;
}
</style>
