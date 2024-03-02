<script setup>
import AppHead from '@/Components/Sections/AppHead.vue'
import AppPanel from '@/Components/Sections/AppPanel.vue'
import LayoutUser from '@/Layouts/LayoutUser.vue'
import DeleteUserForm from './Partials/DeleteUserForm.vue'
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue'
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue'

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
      <h2 class="font-semibold text-md text-gray-900 dark:text-gray-100 uppercase tracking-widest">Edit Profile</h2>
    </template>

    <AppPanel>
      <UpdateProfileInformationForm
        :must-verify-email="metadata.mustVerifyEmail"
        :status="metadata.status"
      />
    </AppPanel>

    <AppPanel>
      <UpdatePasswordForm />
    </AppPanel>

    <AppPanel>
      <DeleteUserForm />
    </AppPanel>
  </LayoutUser>
</template>
