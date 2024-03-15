<script setup>
import LinkButton from '@/Components/Controls/Links/LinkButton.vue'
import OutlineArrowTopRightOnSquare from '@/Components/Icons/HeroIcons/Outline/OutlineArrowTopRightOnSquare.vue'
</script>

<template>
  <section id="template-ui-links" class="py-8">
    <h3 class="w-full pb-4 font-semibold text-xs text-gray-950 dark:text-gray-100 uppercase tracking-widest">Link Components</h3>

    <div class="w-full py-4 flex justify-center bg-gray-200 dark:bg-gray-700">
      <LinkButton
        :href="route('profile.edit')"
      >
        Edit Profile <OutlineArrowTopRightOnSquare class="-mt-0.5 -mr-0.5 ml-2 h-4 w-4" />
      </LinkButton>
    </div>
  </section>
</template>
