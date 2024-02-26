<script setup>
import AppHead from '@/Components/Sections/AppHead.vue'
import AppPanel from '@/Components/Sections/AppPanel.vue'
import LinkButtonPrimary from '@/Components/Navs/Links/LinkButtonPrimary.vue'
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
      <h2 class="font-semibold text-md text-gray-900 dark:text-white uppercase tracking-widest">Dashboard</h2>
    </template>

    <AppPanel>
      <h3 class="font-semibold text-sm text-gray-900 dark:text-white uppercase tracking-widest">Account: {{ $page.props.auth.user.name }} ({{ $page.props.auth.user.email }})</h3>

      <hr class="my-6" />

      <div class="flex justify-end">
        <LinkButtonPrimary
          class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-200 focus:ring-offset-2 transition ease-in-out duration-150"
          :href="route('profile.edit')"
        >Edit Profile</LinkButtonPrimary>
      </div>
    </AppPanel>
  </LayoutUser>
</template>
