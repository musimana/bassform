<script setup>
defineProps({
  message: {
    type: String,
  },
})
</script>

<template>
  <div class="min-h-6">
    <p v-show="message" class="text-sm text-red-600">
      ✗ {{ message }}
    </p>
  </div>
</template>
