<script setup>
import DropdownHover from '@/Components/Navs/Dropdowns/DropdownHover.vue'
import DropdownLink from '@/Components/Navs/Dropdowns/DropdownLink.vue'
import SvgUser from '@/Components/Images/Svgs/Outline/SvgUser.vue'
</script>

<template>
  <DropdownHover align="right" width="24">
    <template #trigger>
      <a
        :href="route('login')"
        class="w-8 h-8 flex m-auto border focus:border-2 border-gray-900 dark:border-gray-100 hover:border-gray-600 dark:hover:border-gray-300 rounded-full"
      >
        <SvgUser class="w-4 h-4 lg:m-auto stroke-gray-900 hover:stroke-gray-600 dark:stroke-gray-100 dark:hover:stroke-gray-300" />
      </a>
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
