<script setup>
import FooterCopyright from '@/Components/Sections/Footers/FooterCopyright.vue'
import FooterSocialLinks from '@/Components/Sections/Footers/FooterSocialLinks.vue'
import { store } from '@/store.js'
import { computed } from 'vue'

const marginBottomClass = computed(() => {
  return store.cookies.acknowledged ? 'mb-0' : 'mb-20'
})

</script>

<template>
  <footer
    class="absolute bottom-0 w-full flex m-auto pb-4 md:pt-4 px-6 lg:px-8 items-center justify-between text-sm text-gray-900 dark:text-gray-100"
    :class="marginBottomClass"
  >
    <FooterCopyright />

    <FooterSocialLinks />
  </footer>
</template>
