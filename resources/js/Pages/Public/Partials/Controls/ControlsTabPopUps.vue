<script setup>
import ControlsSectionAccordions from '@/Pages/Public/Partials/Controls/ControlsSectionAccordions.vue'
import ControlsSectionDropdownClick from '@/Pages/Public/Partials/Controls/ControlsSectionDropdownClick.vue'
import ControlsSectionDropdownHover from '@/Pages/Public/Partials/Controls/ControlsSectionDropdownHover.vue'
import ControlsSectionModals from '@/Pages/Public/Partials/Controls/ControlsSectionModals.vue'
</script>

<template>
  <article class="w-full mb-8 text-md text-gray-600 dark:text-gray-400">
    <ControlsSectionAccordions />

    <ControlsSectionDropdownClick />

    <ControlsSectionDropdownHover />

    <ControlsSectionModals />
  </article>
</template>
