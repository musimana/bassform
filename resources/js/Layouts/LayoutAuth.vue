<script setup>
import AppBody from '@/Components/Sections/AppBody.vue'
import IconAppLogo from '@/Components/Icons/IconAppLogo.vue'
import { Link } from '@inertiajs/vue3'
</script>

<template>
  <AppBody>
    <main class="flex flex-col justify-center items-center min-h-screen pt-6 sm:pt-0">
      <Link :href="route('home')">
        <IconAppLogo class="w-20 h-20 fill-blue-800 dark:fill-blue-200 stroke-blue-800 dark:stroke-blue-200" />
      </Link>

      <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-gray-100 dark:bg-transparent shadow-md dark:shadow-none overflow-hidden sm:rounded-lg selection:bg-red-500 selection:text-white">
        <slot />
      </div>
    </main>
  </AppBody>
</template>
