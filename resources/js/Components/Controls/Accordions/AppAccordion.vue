<script setup>
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

    <button
      class="absolute bottom-0 right-0 mb-1 mr-2 border-t border-blue-950 dark:border-blue-200 text-md px-2 text-blue-950 dark:text-blue-200 hover:text-blue-800 dark:hover:text-blue-100 transition ease-in-out duration-150 cursor-pointer"
      type="button"
    >
      <span class="m-auto">Show {{ state.showingDetails ? 'Less' : 'More' }}</span>
    </button>
  </div>
</template>
