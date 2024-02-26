<script setup>
import AppBody from '@/Components/Sections/AppBody.vue'
import AppFooter from '@/Components/Sections/AppFooter.vue'
import AppHeader from '@/Components/Sections/AppHeader.vue'
import AppMainContent from '@/Components/Sections/AppMainContent.vue'
import AppPanel from '@/Components/Sections/AppPanel.vue'
</script>

<template>
  <AppBody>
    <AppHeader />

    <AppMainContent>
      <AppPanel v-if="$slots.pageHeader">
        <header>
          <slot name="pageHeader" />
        </header>
      </AppPanel>

      <slot />
    </AppMainContent>

    <AppFooter />
  </AppBody>
</template>
