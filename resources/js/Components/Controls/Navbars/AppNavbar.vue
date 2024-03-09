<script setup>
import { ref } from 'vue'
import NavbarDesktop from '@/Components/Controls/Navbars/NavbarDesktop.vue'
import NavbarMobile from '@/Components/Controls/Navbars/NavbarMobile.vue'

const showingNavbarMobile = ref(false)

</script>

<template>
  <nav class="w-1/2 flex justify-end">
    <NavbarDesktop :showing-navbar-mobile="showingNavbarMobile" @toggleNavbarMobile="$event => showingNavbarMobile = $event" />

    <NavbarMobile :showing-navbar-mobile="showingNavbarMobile" />
  </nav>
</template>
