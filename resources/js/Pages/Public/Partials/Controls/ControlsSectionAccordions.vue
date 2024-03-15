<script setup>
import AppAccordion from '@/Components/Controls/Accordions/AppAccordion.vue'
</script>

<template>
  <section id="template-ui-accordions" class="py-8 app-article text-gray-600 dark:text-gray-200 text-sm leading-relaxed">
    <h3 class="w-full pb-4 font-semibold text-xs text-gray-950 dark:text-gray-100 uppercase tracking-widest">Accordion Component</h3>

    <AppAccordion>
      <p class="mb-16">Click to expand this content section.</p>

      <p class="mb-4">Click again to shrink.</p>
    </AppAccordion>
  </section>
</template>
