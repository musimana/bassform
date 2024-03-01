<script setup>
import InputError from '@/Components/Forms/Inputs/InputError.vue'
import InputLabel from '@/Components/Forms/Inputs/InputLabel.vue'
import AppModal from '@/Components/Modals/AppModal.vue'
import AppButton from '@/Components/Navs/Buttons/AppButton.vue'
import InputText from '@/Components/Forms/Inputs/InputText.vue'
import { useForm } from '@inertiajs/vue3'
import { nextTick, ref } from 'vue'

const confirmingUserDeletion = ref(false)
const passwordInput = ref(null)

const form = useForm({
  password: '',
})

const closeModal = () => {
  confirmingUserDeletion.value = false

  form.reset()
}

const confirmUserDeletion = () => {
  confirmingUserDeletion.value = true

  nextTick(() => passwordInput.value.focus())
}

const deleteUser = () => {
  form.delete(route('profile.destroy'), {
    preserveScroll: true,
    onSuccess: () => closeModal(),
    onError: () => passwordInput.value.focus(),
    onFinish: () => form.reset(),
  })
}

</script>

<template>
  <section class="space-y-6">
    <header>
      <h3 class="font-semibold text-sm text-gray-900 dark:text-gray-100 uppercase tracking-widest">
        Delete Account
      </h3>
    </header>

    <div class="flex">
      <p class="flex w-full sm:w-1/2 lg:w-4/5 text-gray-600 dark:text-gray-400 text-xs leading-relaxed">
        Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting
        your account, please download any data or information that you wish to retain.
      </p>

      <div class="flex w-full sm:w-1/2 justify-center sm:justify-end">
        <AppButton
          custom-classes="app-button-primary-red-600"
          @click="confirmUserDeletion"
        >Delete Account</AppButton>
      </div>
    </div>

    <AppModal :show="confirmingUserDeletion" @close="closeModal">
      <div class="p-6">
        <h2 class="font-semibold text-sm text-gray-900 dark:text-gray-100 uppercase tracking-widest">
          Are you sure you want to delete your account?
        </h2>

        <p class="mt-4 text-gray-600 dark:text-gray-300 text-sm leading-relaxed">
          Once your account is deleted, all of its resources and data will be permanently deleted. Please
          enter your password to confirm you would like to permanently delete your account.
        </p>

        <div class="mt-8">
          <InputLabel for="password" value="Password" class="sr-only" />

          <InputText
            id="password"
            ref="passwordInput"
            v-model="form.password"
            type="password"
            class="mt-1 mx-auto block w-full sm:w-3/4"
            placeholder="Password"
            @keyup.enter="deleteUser"
          />

          <InputError :message="form.errors.password" class="mt-2 mx-auto block w-full sm:w-3/4" />
        </div>

        <div class="mt-8 flex justify-end">
          <AppButton
            custom-classes="app-button-secondary-gray-100"
            type="button"
            @click="closeModal"
          >Cancel</AppButton>

          <AppButton
            custom-classes="app-button-primary-red-600 ms-3"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
            @click="deleteUser"
          >Delete Account</AppButton>
        </div>
      </div>
    </AppModal>
  </section>
</template>
