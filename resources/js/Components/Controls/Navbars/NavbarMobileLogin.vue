<script setup>
import LinkMobile from '@/Components/Controls/Links/LinkMobile.vue'
</script>

<template>
  <LinkMobile
    v-if="$page.props.metadata.canLogin"
    :href="route('login')"
    >Login</LinkMobile>

  <LinkMobile
    v-if="$page.props.metadata.canRegister"
    :href="route('register')"
    >Register</LinkMobile>
</template>
