<script setup>
import NavbarDesktopItem from '@/Components/Navs/Navbars/NavbarDesktopItem.vue'
</script>

<template>
  <div class="hidden lg:flex space-x-4 lg:my-auto">
    <NavbarDesktopItem
      v-for="(navbarItem,index) in $page.props.metadata.navbarItems"
      :key="index"
      :navbar-item="navbarItem"
    />
  </div>
</template>
