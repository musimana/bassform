<script setup>
import DropdownHover from '@/Components/Controls/Dropdowns/DropdownHover.vue'
import LinkDropdown from '@/Components/Controls/Links/LinkDropdown.vue'
import OutlineChevronDown from '@/Components/Icons/HeroIcons/Outline/OutlineChevronDown.vue'
</script>

<template>
  <section id="template-ui-dropdowns-hover" class="py-8">
    <h3 class="w-full pb-4 font-semibold text-xs text-gray-950 dark:text-gray-100 uppercase tracking-widest">Dropdown (Hover) Component</h3>

    <div class="w-full py-4 flex justify-center bg-gray-200 dark:bg-gray-700">
      <DropdownHover align="left" offset="16" width="48">
        <template #trigger>
          <span
            class="w-32 flex justify-center border border-gray-900 dark:border-gray-100 p-2 rounded-md font-semibold text-xs uppercase tracking-widest text-gray-950 dark:text-gray-100 cursor-default"
          >
            Hover Here <OutlineChevronDown class="-mr-0.5 h-4 w-4" />
          </span>
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
    </div>
  </section>
</template>
