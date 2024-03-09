<script setup>
import LinkButton from '@/Components/Controls/Links/LinkButton.vue'
</script>

<template>
  <section id="template-ui-links" class="mb-8">
    <h3 class="w-full pb-4 font-semibold text-xs text-gray-950 dark:text-gray-100 uppercase tracking-widest">Link Components</h3>

    <div class="w-full py-4 flex justify-center bg-gray-300 dark:bg-gray-700">
      <LinkButton
        class="w-48 mx-auto flex justify-center"
        :href="route('profile.edit')"
      >Edit Profile</LinkButton>
    </div>
  </section>
</template>
