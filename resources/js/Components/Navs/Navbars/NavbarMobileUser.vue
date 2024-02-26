<script setup>
import LinkMobile from '@/Components/Navs/Links/LinkMobile.vue'
</script>

<template>
  <LinkMobile
    :href="route('dashboard')"
    :active="route().current('dashboard')"
  >Dashboard</LinkMobile>

  <LinkMobile
    :href="route('logout.edit')"
  >Log Out</LinkMobile>
</template>
