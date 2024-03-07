<script setup>
import LinkMobile from '@/Components/Navs/Links/LinkMobile.vue'

defineProps(['showingNavbarMobile'])

defineEmits(['toggleNavbarMobile'])
</script>

<template>
  <div class="pt-2 pb-3 px-3 space-y-1">
    <LinkMobile
      v-for="(navbarItem,index) in $page.props.metadata.navbarItemsMobile"
      :key="index"
      :active="route('home') + $page.url === navbarItem.url"
      :href="navbarItem.url"
    >{{ navbarItem.title }}</LinkMobile>
  </div>
</template>
