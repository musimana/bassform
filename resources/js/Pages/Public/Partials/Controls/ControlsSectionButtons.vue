<script setup>
import AppButton from '@/Components/Controls/Buttons/AppButton.vue'
import InputSuccess from '@/Components/Forms/Inputs/InputSuccess.vue'
import { reactive } from 'vue'

const state = reactive({
  message: '',
})

</script>

<template>
  <section id="template-ui-buttons" class="py-8">
    <header class="flex">
      <h3 class="w-full md:w-1/2 my-auto pb-4 font-semibold text-xs text-gray-950 dark:text-gray-100 uppercase tracking-widest">Button Components</h3>

      <InputSuccess
        v-show="state.message !== ''"
        class="w-full md:w-1/2 my-auto pb-3 text-end"
        :message="state.message"
      />
    </header>

    <div class="w-full p-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-8 justify-between bg-gray-200 dark:bg-gray-700">
      <AppButton
        v-for="(button,index) in [
          {
            label: 'Primary Gray 900',
            classes: 'app-button-primary-gray-900 mx-auto',
          },
          {
            label: 'Primary Red 600',
            classes: 'app-button-primary-red-600 mx-auto',
          },
          {
            label: 'Secondary Gray 100',
            classes: 'app-button-secondary-gray-100 mx-auto',
          },
        ]"
        :key="index"
        :custom-classes="button.classes"
        min-width="lg"
        type="button"
        @click="state.message = 'Button clicked: ' + button.label"
      >{{ button.label }}</AppButton>
    </div>
  </section>
</template>
