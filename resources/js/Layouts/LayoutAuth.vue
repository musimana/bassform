<script setup>
import AppBody from '@/Components/Sections/AppBody.vue'
import AppHead from '@/Components/Sections/AppHead.vue'
import IconAppLogo from '@/Components/Icons/IconAppLogo.vue'
import { Link } from '@inertiajs/vue3'
import { UseDark } from '@vueuse/components'
</script>

<template>
  <UseDark />

  <AppHead :metadata="$page.props.metadata" />

  <AppBody>
    <main class="flex flex-col justify-center items-center min-h-screen pt-6 sm:pt-0">
      <Link :href="route('home')">
        <IconAppLogo class="w-20 h-20 fill-gray-900 dark:fill-gray-100 stroke-gray-900 dark:stroke-gray-100" />
      </Link>

      <section class="w-full sm:max-w-md mt-6 px-6 py-4 bg-gray-100 dark:bg-transparent shadow-md dark:shadow-none overflow-hidden sm:rounded-lg selection:bg-red-500 selection:text-gray-100">
        <slot />
      </section>
    </main>
  </AppBody>
</template>
