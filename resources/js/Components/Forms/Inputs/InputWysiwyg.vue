<script setup>
import CKEditor from '@ckeditor/ckeditor5-vue'
import {
  ClassicEditor,
  Essentials,
  Autoformat,
  Bold,
  Italic,
  BlockQuote,
  Heading,
  Link,
  List,
  Paragraph,
  Table,
  TableToolbar,
  TextTransformation,
} from 'ckeditor5'
import 'ckeditor5/ckeditor5.css'

const model = defineModel({
  type: String,
  required: true,
})

class Editor extends ClassicEditor {
  static builtinPlugins = [
    Essentials,
    Autoformat,
    Bold,
    Italic,
    BlockQuote,
    Heading,
    Link,
    List,
    Paragraph,
    Table,
    TableToolbar,
    TextTransformation,
  ]

  static defaultConfig = {
    toolbar: {
      items: [
        'undo',
        'redo',
        '|',
        'heading',
        '|',
        'bold',
        'italic',
        '|',
        'link',
        'insertTable',
        'blockQuote',
        '|',
        'bulletedList',
        'numberedList',
      ],
    },
    link: {
      decorators: {
        openInNewTab: {
          mode: 'manual',
          label: 'Open in a new tab',
          attributes: {
            target: '_blank',
            rel: 'noopener noreferrer',
          },
        },
      },
    },
    table: {
      contentToolbar: [
        'tableColumn',
        'tableRow',
        'mergeTableCells',
      ],
    },
    language: 'en',
  }
}

Editor
  .create({})
  .catch(error => console.error(error))
</script>

<template>
  <section class="app-article bg-gray-100 dark:bg-gray-900 border-gray-500 focus:border-gray-100 focus:ring-gray-100 rounded-md shadow-sm dark:shadow-none">
    <CKEditor.component
      :editor="Editor"
      v-model="model"
    ></CKEditor.component>
  </section>
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
