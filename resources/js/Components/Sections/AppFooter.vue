<script setup>
import FooterCopyright from '@/Components/Sections/Footers/FooterCopyright.vue'
import FooterSocialLinks from '@/Components/Sections/Footers/FooterSocialLinks.vue'
</script>

<template>
  <footer
    class="absolute bottom-0 w-full flex m-auto pb-4 md:pt-4 px-6 lg:px-8 items-center justify-between text-sm text-gray-900 dark:text-gray-100"
  >
    <FooterCopyright />

    <FooterSocialLinks />
  </footer>
</template>
