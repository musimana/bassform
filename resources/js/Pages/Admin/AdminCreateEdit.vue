<script setup>
import AppPanel from '@/Components/Sections/AppPanel.vue'
import LayoutUser from '@/Layouts/LayoutUser.vue'
import CreateEditPage from './Partials/CreateEditPage.vue'
import { router } from '@inertiajs/vue3'

router.reload({ only: ['content'] })

const props = defineProps({
  content: {
    type: Object,
    required: true,
  },
  metadata: {
    type: Object,
    required: true,
  },
})

</script>

<template>
  <LayoutUser>
    <AppPanel>
      <CreateEditPage />
    </AppPanel>
  </LayoutUser>
</template>
