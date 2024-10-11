<script setup>
import { Ckeditor } from '@ckeditor/ckeditor5-vue'
import {
  ClassicEditor,
  Essentials,
  Autoformat,
  Bold,
  Italic,
  BlockQuote,
  GeneralHtmlSupport,
  Heading,
  Link,
  List,
  Paragraph,
  Style,
  Table,
  TableToolbar,
  TextTransformation,
  Underline,
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
    GeneralHtmlSupport,
    Heading,
    Link,
    List,
    Paragraph,
    Style,
    Table,
    TableToolbar,
    TextTransformation,
    Underline,
  ]

  static defaultConfig = {
    toolbar: {
      items: [
        'undo',
        'redo',
        '|',
        'heading',
        'style',
        '|',
        'bold',
        'italic',
        'underline',
        '|',
        'link',
        'insertTable',
        'blockQuote',
        '|',
        'bulletedList',
        'numberedList',
      ],
    },
    style: {
      definitions: [
        {
          name: 'Heading 2 - Page Title',
          element: 'h2',
          classes: ['text-page-title'],
        },
        {
          name: 'Heading 3 - Small Print',
          element: 'h3',
          classes: ['text-small-print'],
        },
        {
          name: 'Paragraph - Small Print',
          element: 'p',
          classes: ['text-small-print'],
        },
        {
          name: 'Paragraph - Page Subtitle',
          element: 'p',
          classes: ['text-page-subtitle'],
        },
        {
          name: 'Table - Small Print',
          element: 'table',
          classes: ['text-small-print'],
        },
        {
          name: 'List (Points) - Small Print',
          element: 'ul',
          classes: ['text-small-print'],
        },
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
    <Ckeditor
      :editor="Editor"
      v-model="model"
    ></Ckeditor>
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
