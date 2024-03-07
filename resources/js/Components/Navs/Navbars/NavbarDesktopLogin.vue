<script setup>
import DropdownHover from '@/Components/Navs/Dropdowns/DropdownHover.vue'
import DropdownLink from '@/Components/Navs/Dropdowns/DropdownLink.vue'
import LinkDesktopIcon from '@/Components/Navs/Links/LinkDesktopIcon.vue'
import OutlineUser from '@/Components/Icons/HeroIcons/Outline/OutlineUser.vue'
</script>

<template>
  <DropdownHover align="right" width="24">
    <template #trigger>
      <LinkDesktopIcon
        :href="route('login')"
      >
        <OutlineUser class="w-4 h-4 lg:m-auto stroke-gray-900 hover:stroke-gray-600 dark:stroke-gray-100 dark:hover:stroke-gray-300" />
      </LinkDesktopIcon>
    </template>

    <template #content>
      <DropdownLink
        :href="route('login')"
      >Login</DropdownLink>

      <DropdownLink
        v-if="$page.props.metadata.canRegister"
        :href="route('register')"
      >Register</DropdownLink>
    </template>
  </DropdownHover>
</template>
