<script setup>
import DropdownHover from '@/Components/Controls/Dropdowns/DropdownHover.vue'
import LinkDropdown from '@/Components/Controls/Links/LinkDropdown.vue'
import LinkDesktop from '@/Components/Controls/Links/LinkDesktop.vue'
import LinkDesktopDud from '@/Components/Controls/Links/LinkDesktopDud.vue'
import OutlineChevronDown from '@/Components/Icons/HeroIcons/Outline/OutlineChevronDown.vue'

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
          {{ props.navbarItem.title }} <OutlineChevronDown class="fill-current -mr-1 h-4 w-4" />
        </LinkDesktop>

        <LinkDesktopDud
          v-else
          class="h-full my-auto gap-x-1"
        >
          {{ props.navbarItem.title }} <OutlineChevronDown class="fill-current -mr-1 h-4 w-4" />
        </LinkDesktopDud>
      </template>

      <template #content>
        <LinkDropdown
          v-for="(subItem,index) in props.navbarItem.subItems"
          :key="index"
          :href="subItem.url"
        >{{ subItem.title }}</LinkDropdown>
      </template>
    </DropdownHover>
  </div>

  <LinkDesktop
    v-else
    :active="route('home') + $page.url === props.navbarItem.url"
    :href="props.navbarItem.url"
  >{{ props.navbarItem.title }}</LinkDesktop>
</template>
