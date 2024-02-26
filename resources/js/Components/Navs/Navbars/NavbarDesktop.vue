<script setup>
import NavbarDesktopItems from '@/Components/Navs/Navbars/NavbarDesktopItems.vue'
import NavbarDesktopLogin from '@/Components/Navs/Navbars/NavbarDesktopLogin.vue'
import NavbarDesktopUser from '@/Components/Navs/Navbars/NavbarDesktopUser.vue'
import ButtonHamburger from '@/Components/Navs/Buttons/ButtonHamburger.vue'

defineProps(['showingNavbarMobile'])

defineEmits(['toggleNavbarMobile'])
</script>

<template>
  <NavbarDesktopItems />

  <span v-if="$page.props.metadata.canLogin || $page.props.metadata.canRegister || $page.props.auth.user" class="hidden lg:flex mx-4 my-auto font-semibold text-blue-800 dark:text-blue-200">|</span>

  <div v-if="$page.props.metadata.canLogin || $page.props.metadata.canRegister || $page.props.auth.user" class="hidden space-x-4 lg:-my-px lg:flex">
    <NavbarDesktopUser v-if="$page.props.auth.user" />

    <NavbarDesktopLogin v-else-if="$page.props.metadata.canLogin || $page.props.metadata.canRegister" />
  </div>

  <ButtonHamburger :showing-navbar-mobile="showingNavbarMobile" @toggleNavbarMobile="$event => $emit('toggleNavbarMobile', $event)" />
</template>
