<script setup>
import AppSectionDivider from '@/Components/Sections/AppSectionDivider.vue'
import ControlsTabButtons from '@/Pages/Public/Partials/Controls/ControlsTabButtons.vue'
import ControlsTabPopUps from '@/Pages/Public/Partials/Controls/ControlsTabPopUps.vue'
import TabBody from '@/Components/Controls/Tabs/TabBody.vue'
import TabControls from '@/Components/Controls/Tabs/TabControls.vue'
</script>

<template>
  <h3 class="w-full pt-4 font-semibold text-xs text-gray-950 dark:text-gray-100 uppercase tracking-widest">Tab Component</h3>

  <TabControls
    class="pt-4 px-4"
    :tabs="['Pop-ups', 'Buttons']"
  />

  <AppSectionDivider margin="min" />

  <TabBody
    class="mx-4 px-4 bg-white dark:bg-gray-900"
    :tab="0"
  >
    <ControlsTabPopUps />
  </TabBody>

  <TabBody
    class="px-4 bg-white dark:bg-gray-900"
    :tab="1"
  >
    <ControlsTabButtons />
  </TabBody>
</template>
