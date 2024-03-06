<script setup>
import AppButton from '@/Components/Navs/Buttons/AppButton.vue'
import DropdownClick from '@/Components/Navs/Dropdowns/DropdownClick.vue'
import OutlineChevronDown from '@/Components/Icons/HeroIcons/Outline/OutlineChevronDown.vue'
</script>

<template>
  <section id="template-ui-dropdowns-click" class="mb-8">
    <h3 class="w-full pb-4 font-semibold text-xs text-gray-950 dark:text-gray-100 uppercase tracking-widest">Dropdown (Click) Component</h3>

    <div class="w-full py-4 flex justify-center bg-gray-300 dark:bg-gray-700">
      <DropdownClick align="left" width="48">
        <template #trigger>
          <AppButton
            custom-classes="app-button-secondary-gray-100"
            type="button"
          >
            Click Here <OutlineChevronDown class="fill-current -mr-0.5 h-4 w-4" />
          </AppButton>
        </template>

        <template #content>
          <span
            v-for="(option,index) in ['A', 'B', 'C']"
            :key="index"
            class="block px-4"
          >{{ option }}</span>
        </template>
      </DropdownClick>
    </div>
  </section>
</template>
