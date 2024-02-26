<script setup>
import LinkDesktop from '@/Components/Navs/Links/LinkDesktop.vue'
</script>

<template>
  <LinkDesktop
    v-if="$page.props.metadata.canLogin"
    :href="route('login')"
    >Login</LinkDesktop
  >

  <LinkDesktop
    v-if="$page.props.metadata.canRegister"
    :href="route('register')"
    >Register</LinkDesktop
  >
</template>
