<script setup>
import AppSectionHtml from '@/Components/Sections/AppSectionHtml.vue'
import LayoutGuest from '@/Layouts/LayoutGuest.vue'
</script>

<template>
  <LayoutGuest>
    <template #pageHeader>
      <h2 class="font-semibold text-md text-gray-900 dark:text-gray-100 uppercase tracking-widest">{{ $page.props.content.heading }}</h2>

      <p class="pt-2 font-semibold text-xs text-gray-900 dark:text-gray-100 uppercase tracking-widest">
        <em>{{ $page.props.content.subheading }}</em>
      </p>
    </template>

    <AppSectionHtml
      v-if="$page.props.content.bodytext !== ''"
      :html="$page.props.content.bodytext"
      :id="$page.props.content.heading.replace(' ', '-').toLowerCase()"
    />

    <slot />
  </LayoutGuest>
</template>
