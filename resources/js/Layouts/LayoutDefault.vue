<script setup>
import AppHead from '@/Components/Sections/AppHead.vue'
import LayoutGuest from '@/Layouts/LayoutGuest.vue'
</script>

<template>
  <AppHead :metadata="$page.props.metadata" />

  <LayoutGuest>
    <template #pageHeader>
      <h2 class="font-semibold text-md text-gray-900 dark:text-gray-100 uppercase tracking-widest">{{ $page.props.content.title }}</h2>

      <p class="pt-2 font-semibold text-xs text-gray-900 dark:text-gray-100 uppercase tracking-widest">
        <em>{{ $page.props.content.subtitle }}</em>
      </p>
    </template>

    <div class="w-full mb-8" v-if="$page.props.content.article">
      <article
        v-html="$page.props.content.article"
        :id="$page.props.content.title.replace(' ', '-').toLowerCase()"
        class="app-article text-gray-600 dark:text-gray-200 text-sm leading-relaxed"
      ></article>
      <!-- <section
        v-html="$page.props.content.bodytext"
        class="mb-8 text-md text-gray-600 dark:text-gray-400"
      ></section> -->
    </div>

    <slot />
  </LayoutGuest>
</template>
