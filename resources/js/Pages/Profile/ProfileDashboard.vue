<script setup>
import AppHead from '@/Components/Sections/AppHead.vue'
import AppPanel from '@/Components/Sections/AppPanel.vue'
import LinkButton from '@/Components/Navs/Links/LinkButton.vue'
import LayoutUser from '@/Layouts/LayoutUser.vue'

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
  <AppHead :metadata="metadata" />

  <LayoutUser>
    <template #pageHeader>
      <h2 class="font-semibold text-md text-gray-900 dark:text-gray-100 uppercase tracking-widest">Dashboard</h2>
    </template>

    <AppPanel>
      <h3 class="font-semibold text-sm text-gray-900 dark:text-gray-100 uppercase tracking-widest">Account: {{ $page.props.auth.user.name }} ({{ $page.props.auth.user.email }})</h3>

      <hr class="my-6" />

      <div class="flex justify-end">
        <LinkButton :href="route('profile.edit')">Edit Profile</LinkButton>
      </div>
    </AppPanel>
  </LayoutUser>
</template>
