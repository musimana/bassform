<script setup>
import LinkDesktop from '@/Components/Navs/Links/LinkDesktop.vue'
import SvgUser from '@/Components/Images/Svgs/Outline/SvgUser.vue'
</script>

<template>
  <a
    v-if="$page.props.metadata.canLogin"
    :href="route('login')"
    class="w-8 h-8 flex m-auto border focus:border-2 border-gray-900 dark:border-gray-100 hover:border-gray-600 dark:hover:border-gray-300 rounded-full"
  >
    <SvgUser class="w-4 h-4 lg:m-auto stroke-gray-900 hover:stroke-gray-600 dark:stroke-gray-100 dark:hover:stroke-gray-300" />
  </a>

  <!-- <LinkDesktop
    v-if="$page.props.metadata.canRegister"
    :href="route('register')"
    >Register</LinkDesktop
  > -->
</template>
