<script setup>
import AppSectionDivider from '@/Components/Sections/AppSectionDivider.vue'
import TabBody from '@/Components/Controls/Tabs/TabBody.vue'
import TabControls from '@/Components/Controls/Tabs/TabControls.vue'

defineProps({
  blockData: {
    type: Object,
    required: true,
  },
})
</script>

<template>
  <TabControls
    class="pt-4"
    :tabs="blockData.tabs ?? {}"
  />

  <AppSectionDivider margin="min" />

  <TabBody
    v-for="(tab, index) in blockData.tabs"
    :key="index"
    class="px-4 bg-white dark:bg-gray-900"
    :tab="index"
  >
    <div v-html="blockData?.tabContents[index]"></div>
  </TabBody>
</template>
