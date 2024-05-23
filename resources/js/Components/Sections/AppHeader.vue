<script setup>
import AppNavbar from '@/Components/Controls/Navbars/AppNavbar.vue'
import IconAppLogo from '@/Components/Icons/IconAppLogo.vue'
import { Link } from '@inertiajs/vue3'
</script>

<template>
  <header class="w-full flex h-18 fixed top-0 lg:right-0 z-50 m-auto px-6 lg:px-8 py-6 bg-gray-100 dark:bg-gray-700 dark:bg-gradient-to-bl from-gray-700 via-transparent text-gray-900 dark:text-gray-100 hover:text-gray-600 dark:hover:text-gray-300 dark:ring-1 dark:ring-inset dark:ring-gray-100/5 shadow-2xl shadow-gray-500/20 dark:shadow-none">
    <div class="w-1/2 flex">
      <Link :href="route('home')" class="my-auto shrink-0 flex items-start space-x-4 focus:outline-none focus:rounded-sm focus:ring-2 focus:ring-gray-900 dark:focus:ring-gray-100">
        <IconAppLogo id="site-logo" class="w-8 h-8" />

        <h1 id="site-title" class="my-auto text-lg lg:text-xl font-semibold">{{ $page.props.metadata.appName }}</h1>
      </Link>
    </div>

    <AppNavbar />
  </header>
</template>
