<script setup>
import NavbarDesktopItem from '@/Components/Controls/Navbars/NavbarDesktopItem.vue'
</script>

<template>
  <NavbarDesktopItem
    v-for="(navbarItem,index) in $page.props.metadata.navbarDesktop"
    :key="index"
    :navbar-item="navbarItem"
  />
</template>
