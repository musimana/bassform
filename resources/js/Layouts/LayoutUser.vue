<script setup>
import AppBody from '@/Components/Sections/AppBody.vue'
import AppFooter from '@/Components/Sections/AppFooter.vue'
import AppHead from '@/Components/Sections/AppHead.vue'
import AppHeader from '@/Components/Sections/AppHeader.vue'
import AppMainContent from '@/Components/Sections/AppMainContent.vue'
import AppPanel from '@/Components/Sections/AppPanel.vue'
</script>

<template>
  <AppHead :metadata="$page.props.metadata" />

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
