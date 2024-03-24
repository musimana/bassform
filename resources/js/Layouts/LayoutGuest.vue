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
      <AppPanel>
        <header v-if="$slots.pageHeader" class="mb-8">
          <slot name="pageHeader" />
        </header>

        <slot />
      </AppPanel>
    </AppMainContent>

    <AppFooter />
  </AppBody>
</template>
