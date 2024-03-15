<script setup>
import { onMounted } from 'vue'
import { store } from '@/store.js'

const props = defineProps({
  tabsKey: {
    type: Number,
    default: 0,
  },
  tabs: {
    type: Object,
    default: () => ({}),
  },
})

const selectTab = (tab) => {
  if (tab !== store.tabs[0].activeTab) {
    store.tabs[0].activeTab = tab
  }
}

onMounted(() => selectTab(0))
</script>

<template>
  <nav>
    <button
      v-for="(tab,index) in props.tabs"
      :key="index"
      class="inline-flex space-x-2 border-t border-x rounded-t-lg px-6 py-3 bg-white dark:bg-gray-900 transition ease-in-out duration-150 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 dark:focus:ring-gray-100 focus:rounded-sm"
      :class="{ 'border-gray-900 dark:border-gray-100 font-semibold cursor-default': index === store.tabs[0].activeTab, 'border-gray-400 dark:border-gray-300 opacity-75 hover:opacity-100 cursor-pointer': index !== store.tabs[0].activeTab }"
      type="button"
      @click="selectTab(index)"
    >
      <h3
        class="my-auto text-xs uppercase tracking-widest"
        :class="{ 'font-bold text-gray-900 dark:text-gray-100': index === store.tabs[0].activeTab, 'font-semibold text-gray-600 dark:text-gray-300': index !== store.tabs[0].activeTab }"
      >{{ tab }}</h3>
    </button>
  </nav>
</template>
