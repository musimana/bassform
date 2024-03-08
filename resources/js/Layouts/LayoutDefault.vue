<script setup>
import AppHead from '@/Components/Sections/AppHead.vue'
import LayoutGuest from '@/Layouts/LayoutGuest.vue'
</script>

<template>
  <AppHead :metadata="$page.props.metadata" />

  <LayoutGuest>
    <template #pageHeader>
      <h2 class="font-semibold text-md text-gray-900 dark:text-gray-100 uppercase tracking-widest">{{ $page.props.content.heading }}</h2>

      <p class="pt-2 font-semibold text-xs text-gray-900 dark:text-gray-100 uppercase tracking-widest">
        <em>{{ $page.props.content.subheading }}</em>
      </p>
    </template>

    <div class="w-full mb-8" v-if="$page.props.content.bodytext !== ''">
      <article
        v-html="$page.props.content.bodytext"
        :id="$page.props.content.heading.replace(' ', '-').toLowerCase()"
        class="app-article text-gray-600 dark:text-gray-200 text-sm leading-relaxed"
      ></article>
    </div>

    <slot />
  </LayoutGuest>
</template>
