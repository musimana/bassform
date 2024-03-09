<script setup>
import AppSectionDivider from '@/Components/Sections/AppSectionDivider.vue'
import ControlsTabButtons from '@/Pages/Public/Partials/Controls/ControlsTabButtons.vue'
import ControlsTabPopUps from '@/Pages/Public/Partials/Controls/ControlsTabPopUps.vue'
import TabBody from '@/Components/Controls/Tabs/TabBody.vue'
import TabControls from '@/Components/Controls/Tabs/TabControls.vue'
</script>

<template>
  <h3 class="w-full pt-4 font-semibold text-xs text-gray-950 dark:text-gray-100 uppercase tracking-widest">Tab Component</h3>

  <TabControls :tabs-key="0" :tabs="$page.props.content?.blocks[0]?.tabs ?? {}" class="pt-4" />

  <AppSectionDivider margin="min" />

  <TabBody
    :key="0"
    :tab="0"
    :tabs-key="0"
    class="px-4 bg-white dark:bg-gray-900"
  >
    <ControlsTabPopUps />
  </TabBody>

  <TabBody
    :key="1"
    :tab="1"
    :tabs-key="0"
    class="px-4 bg-white dark:bg-gray-900"
  >
    <ControlsTabButtons />
  </TabBody>
</template>
