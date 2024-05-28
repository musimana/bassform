<script setup>
import { store } from '@/store.js'
import { computed } from 'vue'

const marginBottomClass = computed(() => {
  return store.cookies.acknowledged ? 'mb-0' : 'mb-20'
})

</script>

<template>
  <main
    class="w-full min-h-screen mx-auto lg:mt-0 px-6 lg:px-8 py-20 md:py-28"
    :class="marginBottomClass"
  >
    <slot />
  </main>
</template>
