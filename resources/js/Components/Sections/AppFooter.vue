<script setup>
import IconGithub from '@/Components/Icons/IconGithub.vue'
</script>

<template>
  <footer class="absolute bottom-0 flex w-full m-auto pb-4 md:pt-4 px-6 lg:px-8 items-center justify-between">
    <div class="w-1/2 text-sm text-gray-900 dark:text-gray-100 text-start">
      <div v-if="$page.props.metadata.copyright !== ''" class="flex items-center gap-2">
        {{ $page.props.metadata.copyright }}
      </div>
    </div>

    <div class="w-1/2 text-sm text-gray-900 dark:text-gray-100 text-end">
      <nav class="flex justify-end items-center gap-2">
        <a
          v-if="$page.props.metadata.links.github"
          class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 dark:focus:ring-gray-100 focus:rounded-sm"
          :href="$page.props.metadata.links.github"
          title="Github Repo"
          target="_blank"
          rel="noopener noreferrer"
        >
          <IconGithub class="w-6 h-6 fill-gray-900 dark:fill-gray-100 hover:fill-gray-600 dark:hover:fill-gray-300 cursor-pointer" />
        </a>
      </nav>
    </div>
  </footer>
</template>
