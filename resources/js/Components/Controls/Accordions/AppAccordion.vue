<script setup>
import AppButton from '@/Components/Controls/Buttons/AppButton.vue'
import { reactive } from 'vue'

const state = reactive({
  showingDetails: false,
})

</script>

<template>
  <div
    class="relative px-4 py-10 transition ease-in-out duration-150"
    :class="{ 'h-32 overflow-hidden' : !state.showingDetails }"
    @click="state.showingDetails = !state.showingDetails"
  >
    <span
      class="-mx-4 -my-10"
      :class="{ 'absolute block w-full h-full bg-gradient-to-t via-transparent from-gray-200 dark:from-gray-700 cursor-pointer' : !state.showingDetails, 'hidden' : state.showingDetails }"
    >&nbsp;</span>

    <slot />

    <AppButton
      base-classes="absolute bottom-0 right-0 mb-1 mr-2 text-md px-2 transition ease-in-out duration-150 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 dark:focus:ring-gray-100 focus:rounded-sm"
      custom-classes="border-t border-gray-800 dark:border-gray-200 text-gray-800 dark:text-gray-200 hover:text-gray-500 dark:hover:text-gray-300"
      type="button"
    >
      <span class="m-auto">Show {{ state.showingDetails ? 'Less' : 'More' }}</span>
    </AppButton>
  </div>
</template>
