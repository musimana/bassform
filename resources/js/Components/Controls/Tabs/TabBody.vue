<script setup>
import { store } from '@/store.js'

defineProps({
  tabsKey: {
    type: Number,
    default: 0,
  },
  tab: {
    type: Number,
    required: true,
  },
})
</script>

<template>
  <div :class="{ 'hidden' : tab !== store.tabs[tabsKey].activeTab}">
    <slot></slot>
  </div>
</template>
