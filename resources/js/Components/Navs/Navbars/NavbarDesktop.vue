<script setup>
import ControlDarkMode from '@/Components/Navs/ControlDarkMode.vue'
import NavbarDesktopItems from '@/Components/Navs/Navbars/NavbarDesktopItems.vue'
import NavbarDesktopLogin from '@/Components/Navs/Navbars/NavbarDesktopLogin.vue'
import NavbarDesktopUser from '@/Components/Navs/Navbars/NavbarDesktopUser.vue'
import ButtonHamburger from '@/Components/Navs/Buttons/ButtonHamburger.vue'

defineProps(['showingNavbarMobile'])

defineEmits(['toggleNavbarMobile'])
</script>

<template>
  <NavbarDesktopItems />

  <span class="hidden lg:flex mx-4 my-auto font-semibold text-gray-900 dark:text-gray-100 cursor-default">|</span>

  <div class="hidden space-x-4 lg:flex">
    <ControlDarkMode />

    <NavbarDesktopUser v-if="$page.props.auth.user" />

    <NavbarDesktopLogin v-else-if="$page.props.metadata.canLogin || $page.props.metadata.canRegister" />
  </div>

  <ButtonHamburger :showing-navbar-mobile="showingNavbarMobile" @toggleNavbarMobile="$event => $emit('toggleNavbarMobile', $event)" />
</template>
