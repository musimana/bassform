<script setup>
import IconAppLogo from '@/Components/Icons/IconAppLogo.vue'
import AppNavbar from '@/Components/Navs/Navbars/AppNavbar.vue'
import { Link } from '@inertiajs/vue3'
</script>

<template>
  <header class="w-full flex h-18 fixed top-0 lg:right-0 m-auto px-6 lg:px-8 py-6 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl from-gray-700 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 shadow-2xl shadow-gray-500/20 dark:shadow-none">
    <div class="w-1/2 flex">
      <Link id="site-logo" :href="route('home')" class="shrink-0 flex items-start space-x-2">
        <IconAppLogo class="w-7 h-7 stroke-blue-800 fill-blue-800 dark:stroke-blue-200 dark:fill-blue-200" />

        <h1 id="site-title" class="text-lg lg:text-xl font-semibold text-gray-900 dark:text-white">{{ $page.props.metadata.appName }}</h1>
      </Link>
    </div>

    <AppNavbar />
  </header>
</template>
