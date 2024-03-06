<script setup>
import DropdownHover from '@/Components/Navs/Dropdowns/DropdownHover.vue'
import DropdownLink from '@/Components/Navs/Dropdowns/DropdownLink.vue'
import LinkDesktop from '@/Components/Navs/Links/LinkDesktop.vue'
import LinkDesktopDud from '@/Components/Navs/Links/LinkDesktopDud.vue'
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
    <DropdownHover align="right" width="48">
      <template #trigger>
        <LinkDesktop
          v-if="props.navbarItem.url"
          class="h-full my-auto gap-x-1"
          :active="route('home') + $page.url === props.navbarItem.url"
          :href="props.navbarItem.url"
        >
          {{ props.navbarItem.title }} <SvgChevronDown class="fill-current -mr-0.5 h-4 w-4" />
        </LinkDesktop>

        <LinkDesktopDud
          v-else
          class="h-full my-auto gap-x-1"
        >
          {{ props.navbarItem.title }} <SvgChevronDown class="fill-current -mr-0.5 h-4 w-4" />
        </LinkDesktopDud>
      </template>

      <template #content>
        <DropdownLink
          v-for="(subItem,index) in props.navbarItem.subItems"
          :key="index"
          :href="subItem.url"
        >{{ subItem.title }}</DropdownLink>
      </template>
    </DropdownHover>
  </div>

  <LinkDesktop
    v-else
    :active="route('home') + $page.url === props.navbarItem.url"
    :href="props.navbarItem.url"
  >{{ props.navbarItem.title }}</LinkDesktop>
</template>
