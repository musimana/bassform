<script setup>
import AppSectionDivider from '@/Components/Sections/AppSectionDivider.vue'
import DropdownHover from '@/Components/Controls/Dropdowns/DropdownHover.vue'
import DropdownLink from '@/Components/Controls/Dropdowns/DropdownLink.vue'
import LinkDesktopIcon from '@/Components/Controls/Links/LinkDesktopIcon.vue'
import OutlineUser from '@/Components/Icons/HeroIcons/Outline/OutlineUser.vue'
</script>

<template>
  <DropdownHover align="right" width="24">
    <template #trigger>
      <LinkDesktopIcon
        :href="route('dashboard')"
        :active="route().current('dashboard')"
        >
          <OutlineUser class="w-4 h-4 lg:m-auto stroke-gray-900 hover:stroke-gray-600 dark:stroke-gray-100 dark:hover:stroke-gray-300" />
        </LinkDesktopIcon>
    </template>

    <template #content>
      <DropdownLink
        :href="route('dashboard')"
        :active="route().current('dashboard')"
      >Dashboard</DropdownLink>

      <DropdownLink
        :href="route('profile.edit')"
        :active="route().current('profile.edit')"
      >Account</DropdownLink>

      <AppSectionDivider margin="sm" />

      <DropdownLink
        :href="route('logout.edit')"
      >Logout</DropdownLink>
    </template>
  </DropdownHover>
</template>
