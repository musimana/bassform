<script setup />

<template>
  <div class="w-1/2 text-start">
    <div v-if="$page.props.metadata.copyright !== ''" class="flex items-center gap-2">
      {{ $page.props.metadata.copyright }}
    </div>
  </div>
</template>
