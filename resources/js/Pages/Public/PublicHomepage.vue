<script setup>
import IconAppLogo from '@/Components/Icons/IconAppLogo.vue'
import LayoutGuest from '@/Layouts/LayoutGuest.vue'
import ContentHomepage from '@/Pages/Public/Partials/ContentHomepage.vue'

defineProps({
  content: {
    type: Object,
    default: () => ({}),
  },
  metadata: {
    type: Object,
    default: () => ({}),
  },
})
</script>

<template>
  <LayoutGuest>
    <template #pageHeader>
      <div class="flex justify-center gap-x-4 mt-4">
        <IconAppLogo class="w-12 h-12 stroke-gray-900 fill-gray-900  dark:stroke-gray-100 dark:fill-gray-100" />

        <h2 class="my-auto text-center text-xl font-bold text-gray-900 dark:text-gray-100">{{ $page.props.content.heading }}</h2>
      </div>

      <p
        v-if="$page.props.content.subheading !== ''"
        class="w-full text-center pt-8 font-semibold text-xs text-gray-600 dark:text-gray-400 uppercase tracking-wide"
      >
        {{ $page.props.content.subheading }}
      </p>
    </template>

    <ContentHomepage />
  </LayoutGuest>
</template>
