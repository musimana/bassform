<script setup>
import LinkMobile from '@/Components/Controls/Links/LinkMobile.vue'
import OutlineArrowRightStartOnRectangle from '@/Components/Icons/HeroIcons/Outline/OutlineArrowRightStartOnRectangle.vue'
</script>

<template>
  <LinkMobile
    :href="route('dashboard')"
    :active="route().current('dashboard')"
  >Dashboard</LinkMobile>

  <LinkMobile
    :href="route('logout.edit')"
  >
    Log Out  <OutlineArrowRightStartOnRectangle class="ml-1 my-auto h-4 w-4" />
  </LinkMobile>
</template>
