<script setup>
import ControlDarkMode from '@/Components/Controls/ControlDarkMode.vue'
import NavbarDesktopItems from '@/Components/Controls/Navbars/NavbarDesktopItems.vue'
import NavbarDesktopLogin from '@/Components/Controls/Navbars/NavbarDesktopLogin.vue'
import NavbarDesktopUser from '@/Components/Controls/Navbars/NavbarDesktopUser.vue'

defineProps(['showingNavbarMobile'])

defineEmits(['toggleNavbarMobile'])
</script>

<template>
  <div class="hidden lg:flex space-x-6 lg:my-auto">
    <NavbarDesktopItems />

    <ControlDarkMode />

    <NavbarDesktopUser v-if="$page.props.auth.user" />

    <NavbarDesktopLogin v-else-if="$page.props.metadata.canLogin" />
  </div>
</template>
