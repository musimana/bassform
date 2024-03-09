<script setup>
import AppNavbar from '@/Components/Controls/Navbars/AppNavbar.vue'
import IconAppLogo from '@/Components/Icons/IconAppLogo.vue'
import { Link } from '@inertiajs/vue3'
</script>

<template>
  <header class="w-full flex h-18 fixed top-0 lg:right-0 m-auto px-6 lg:px-8 py-6 bg-gray-100 dark:bg-gray-700 dark:bg-gradient-to-bl from-gray-700 via-transparent dark:ring-1 dark:ring-inset dark:ring-gray-100/5 shadow-2xl shadow-gray-500/20 dark:shadow-none">
    <div class="w-1/2 flex">
      <Link id="site-logo" :href="route('home')" class="my-auto shrink-0 flex items-start space-x-4">
        <IconAppLogo class="w-8 h-8 stroke-gray-900 fill-gray-900 hover:stroke-gray-600 hover:fill-gray-600 dark:stroke-gray-100 dark:fill-gray-100 dark:hover:stroke-gray-300 dark:hover:fill-gray-300" />

        <h1 id="site-title" class="my-auto text-lg lg:text-xl font-semibold text-gray-900 dark:text-gray-100 hover:text-gray-600 dark:hover:text-gray-300">{{ $page.props.metadata.appName }}</h1>
      </Link>
    </div>

    <AppNavbar />
  </header>
</template>
