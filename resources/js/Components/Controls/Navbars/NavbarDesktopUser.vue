<script setup>
import AppSectionDivider from '@/Components/Sections/AppSectionDivider.vue'
import DropdownHover from '@/Components/Controls/Dropdowns/DropdownHover.vue'
import LinkDropdown from '@/Components/Controls/Links/LinkDropdown.vue'
import LinkDesktopIcon from '@/Components/Controls/Links/LinkDesktopIcon.vue'
import OutlineUser from '@/Components/Icons/HeroIcons/Outline/OutlineUser.vue'
import OutlineArrowRightStartOnRectangle from '@/Components/Icons/HeroIcons/Outline/OutlineArrowRightStartOnRectangle.vue'
</script>

<template>
  <DropdownHover align="right" width="24">
    <template #trigger>
      <LinkDesktopIcon
        :active="true"
        :href="route('dashboard')"
      >
        <OutlineUser class="w-4 h-4 lg:m-auto stroke-gray-900 hover:stroke-gray-600 dark:stroke-gray-100 dark:hover:stroke-gray-300" />
      </LinkDesktopIcon>
    </template>

    <template #content>
      <LinkDropdown
        :href="route('dashboard')"
        :active="route().current('dashboard')"
      >Dashboard</LinkDropdown>

      <LinkDropdown
        :href="route('profile.edit')"
        :active="route().current('profile.edit')"
      >Account</LinkDropdown>

      <AppSectionDivider margin="sm" />

      <LinkDropdown
        :href="route('logout.edit')"
      >
        Logout <OutlineArrowRightStartOnRectangle class="ml-1 h-5 w-5" />
      </LinkDropdown>
    </template>
  </DropdownHover>
</template>
