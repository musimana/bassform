<script setup>
import DropdownHover from '@/Components/Controls/Dropdowns/DropdownHover.vue'
import LinkDropdown from '@/Components/Controls/Links/LinkDropdown.vue'
import LinkDesktopIcon from '@/Components/Controls/Links/LinkDesktopIcon.vue'
import OutlineUser from '@/Components/Icons/HeroIcons/Outline/OutlineUser.vue'
</script>

<template>
  <DropdownHover align="right" width="24">
    <template #trigger>
      <LinkDesktopIcon
        class="text-gray-900 hover:text-gray-600 dark:text-gray-100 dark:hover:text-gray-300"
        :href="route('login')"
      >
        <OutlineUser class="w-4 h-4 lg:m-auto" />
      </LinkDesktopIcon>
    </template>

    <template #content>
      <LinkDropdown
        :href="route('login')"
      >Login</LinkDropdown>

      <LinkDropdown
        v-if="$page.props.metadata.canRegister"
        :href="route('register')"
      >Register</LinkDropdown>
    </template>
  </DropdownHover>
</template>
