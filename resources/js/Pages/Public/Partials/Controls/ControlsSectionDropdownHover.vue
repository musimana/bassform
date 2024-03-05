<script setup>
import DropdownHover from '@/Components/Navs/Dropdowns/DropdownHover.vue'
import DropdownLink from '@/Components/Navs/Dropdowns/DropdownLink.vue'
</script>

<template>
  <section id="template-ui-dropdowns-hover" class="mb-8">
    <h3 class="w-full pb-4 font-semibold text-xs text-gray-950 dark:text-gray-100 uppercase tracking-widest">Dropdown (Hover) Component</h3>

    <div class="w-full py-4 flex justify-center bg-gray-300 dark:bg-gray-700">
      <DropdownHover align="left" width="48">
        <template #trigger>
          <span class="border-2 border-gray-950 dark:border-gray-100 p-2 rounded-md text-gray-950 dark:text-gray-100">Hover Here</span>
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
    </div>
  </section>
</template>
