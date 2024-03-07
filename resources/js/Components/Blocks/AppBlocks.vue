<script setup>
</script>

<template>
  <div
    v-for="(block,index) in $page.props.content.blocks"
    :key="index"
    v-html="block.html"
    class="px-4 pb-12 text-sm text-gray-900 dark:text-gray-100"
  ></div>
</template>
