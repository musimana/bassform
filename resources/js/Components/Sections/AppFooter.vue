<script setup>
import IconGithub from '@/Components/Icons/IconGithub.vue'
</script>

<template>
  <footer class="absolute bottom-0 flex w-full m-auto py-4 px-6 lg:px-8 items-center justify-between">
    <div class="w-1/2 text-sm text-blue-900 dark:text-blue-200 text-start">
      <div v-if="$page.props.metadata.copyright !== ''" class="flex items-center gap-2">
        {{ $page.props.metadata.copyright }}
      </div>
    </div>

    <div class="w-1/2 text-sm text-blue-900 dark:text-blue-200 text-end">
      <nav class="flex justify-end items-center gap-2">
        <a v-if="$page.props.metadata.links.github" :href="$page.props.metadata.links.github" title="Github Profile" target="_blank" rel="noopener noreferrer">
          <IconGithub class="w-6 h-6 fill-blue-900 dark:fill-blue-200 hover:fill-blue-600 hover:dark:fill-blue-100 cursor-pointer" />
        </a>
      </nav>
    </div>
  </footer>
</template>
