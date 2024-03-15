<script setup>
const props = defineProps({
  showingNavbarMobile: {
    type: Boolean,
    required: true,
  },
})

defineEmits(['toggleNavbarMobile'])
</script>

<template>
  <div class="flex items-center lg:hidden">
    <button
      id="nav-hamburger"
      class="p-2 inline-flex items-center justify-center rounded-full border border-gray-600 dark:border-gray-400 text-gray-600 dark:text-gray-400 hover:text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 transition duration-150 ease-in-out"
      type="button"
      @click="$emit('toggleNavbarMobile', !showingNavbarMobile)"
    >
      <svg class="h-4 w-4" stroke="currentColor" fill="none" viewBox="0 0 24 24">
        <path
          :class="{
            hidden: showingNavbarMobile,
            'inline-flex': !showingNavbarMobile,
          }"
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M4 6h16M4 12h16M4 18h16"
        />
        <path
          :class="{
            hidden: !showingNavbarMobile,
            'inline-flex': showingNavbarMobile,
          }"
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M6 18L18 6M6 6l12 12"
        />
      </svg>
    </button>
  </div>
</template>
