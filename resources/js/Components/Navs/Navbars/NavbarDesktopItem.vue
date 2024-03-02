<script setup>
import AppDropdown from '@/Components/Navs/Dropdowns/AppDropdown.vue'
import DropdownLink from '@/Components/Navs/Dropdowns/DropdownLink.vue'
import LinkDesktop from '@/Components/Navs/Links/LinkDesktop.vue'
import SvgChevronDown from '@/Components/Images/Svgs/Outline/SvgChevronDown.vue'

const props = defineProps({
  navbarItem: {
    type: Object,
    required: true,
  },
})

const isEmpty = (obj) => {
  for (const prop in obj) {
    if (Object.hasOwn(obj, prop)) {
      return false
    }
  }

  return true
}

</script>

<template>
  <div class="inline-flex relative" v-if="!isEmpty(props.navbarItem.subItems)">
    <LinkDesktop
      v-if="props.navbarItem.subItems"
      :active="route('home') + $page.url === props.navbarItem.url"
      :href="props.navbarItem.url"
    >
      {{ props.navbarItem.title }}
    </LinkDesktop>

    <AppDropdown align="right" width="48">
      <template #trigger>
        <button
          type="button"
          class="py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-900 dark:text-gray-100 hover:text-gray-600 dark:hover:text-gray-300 focus:outline-4 transition ease-in-out duration-150"
        >
          <SvgChevronDown class="fill-current -mr-0.5 h-4 w-4" />
        </button>
      </template>

      <template #content>
        <DropdownLink
          v-for="(subItem,index) in props.navbarItem.subItems"
          :key="index"
          :href="subItem.url"
        >{{ subItem.title }}</DropdownLink>
      </template>
    </AppDropdown>
  </div>

  <LinkDesktop
    v-else
    :active="route('home') + $page.url === props.navbarItem.url"
    :href="props.navbarItem.url"
  >{{ props.navbarItem.title }}</LinkDesktop>
</template>
