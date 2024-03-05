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
    <ul>
      <li
        v-for="(tab,index) in props.tabs"
        :key="index"
        class="inline-flex space-x-2 border-t border-x  rounded-t-lg pl-6 pr-8 py-4 bg-white dark:bg-gray-900 transition ease-in-out duration-150 "
        :class="{ 'border-blue-950 dark:border-blue-200 text-semibold': index === store.tabs[0].activeTab, 'opacity-75 cursor-pointer': index !== store.tabs[0].activeTab }"
        @click="selectTab(index)"
      >
        <h3
          class="my-auto text-xs uppercase tracking-widest"
          :class="{ 'font-bold text-gray-950 dark:text-white': index === store.tabs[0].activeTab, 'font-semibold text-gray-700 dark:text-gray-300': index !== store.tabs[0].activeTab }"
        >{{ tab }}</h3>
      </li>
    </ul>
  </nav>
</template>
