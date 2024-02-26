<script setup>
import LinkDesktop from '@/Components/Navs/Links/LinkDesktop.vue'
</script>

<template>
  <LinkDesktop
    :href="route('dashboard')"
    :active="route().current('dashboard')"
    >Dashboard</LinkDesktop>

  <LinkDesktop
    :href="route('logout.edit')"
  >Log Out</LinkDesktop>
</template>
