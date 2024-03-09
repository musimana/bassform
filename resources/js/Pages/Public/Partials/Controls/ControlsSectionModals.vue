<script setup>
import AppButton from '@/Components/Controls/Buttons/AppButton.vue'
import AppModal from '@/Components/Modals/AppModal.vue'
import { ref } from 'vue'

const modalShowing = ref(false)

const closeModal = () => {
  modalShowing.value = false
}

const openModal = () => {
  modalShowing.value = true
}

</script>

<template>
  <section id="template-ui-modals" class="mb-8">
    <h3 class="w-full pb-4 font-semibold text-xs text-gray-950 dark:text-gray-100 uppercase tracking-widest">Modal Component</h3>

    <div class="w-full py-4 flex justify-center bg-gray-300 dark:bg-gray-700">
      <AppButton
        custom-classes="app-button-secondary-gray-100"
        type="button"
        @click="openModal"
      >Open Modal</AppButton>
    </div>

    <AppModal :show="modalShowing" @close="closeModal">
      <div class="w-full p-6">
        <h2 class="font-semibold text-sm text-gray-900 dark:text-gray-100 uppercase tracking-widest">
          Modal Content
        </h2>

        <p class="mt-4 text-gray-600 dark:text-gray-300 text-sm leading-relaxed">
          As well as the button below, you can also close the modal by clicking anywhere outside of it.
        </p>

        <p class="mt-4 text-gray-600 dark:text-gray-300 text-sm leading-relaxed">
          See the account deletion form on the <a :href="route('profile.edit')">Edit Profile</a> page for a more complex example.
        </p>

        <div class="mt-8 flex justify-end">
          <AppButton
            custom-classes="app-button-secondary-gray-100"
            type="button"
            @click="closeModal"
          >Close</AppButton>
        </div>
      </div>
    </AppModal>
  </section>
</template>
