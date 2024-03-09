<script setup>
import AppButton from '@/Components/Controls/Buttons/AppButton.vue'
</script>

<template>
  <section id="template-ui-buttons" class="my-8">
    <h3 class="w-full pb-4 font-semibold text-xs text-gray-950 dark:text-gray-100 uppercase tracking-widest">Button Components</h3>

    <div class="w-full p-4 flex justify-between bg-gray-200 dark:bg-gray-700">
      <AppButton
        custom-classes="app-button-primary-gray-900 w-48 mx-auto flex justify-center"
        type="button"
      >Primary Gray 900</AppButton>

      <AppButton
        custom-classes="app-button-primary-red-600 w-48 mx-auto flex justify-center"
        type="button"
      >Primary Red 600</AppButton>

      <AppButton
        custom-classes="app-button-secondary-gray-100 w-48 mx-auto flex justify-center"
        type="button"
      >Secondary Gray 100</AppButton>
    </div>
  </section>
</template>
