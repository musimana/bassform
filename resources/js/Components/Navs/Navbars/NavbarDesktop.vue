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
  <div class="hidden lg:flex space-x-6 lg:my-auto">
    <NavbarDesktopItems />

    <ControlDarkMode />

    <NavbarDesktopUser v-if="$page.props.auth.user" />

    <NavbarDesktopLogin v-else-if="$page.props.metadata.canLogin || $page.props.metadata.canRegister" />
  </div>

  <ButtonHamburger :showing-navbar-mobile="showingNavbarMobile" @toggleNavbarMobile="$event => $emit('toggleNavbarMobile', $event)" />
</template>
