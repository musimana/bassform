<script setup>
import NavbarDesktopItem from '@/Components/Navs/Navbars/NavbarDesktopItem.vue'
</script>

<template>
  <NavbarDesktopItem
    v-for="(navbarItem,index) in $page.props.metadata.navbarItems"
    :key="index"
    :navbar-item="navbarItem"
  />
</template>
