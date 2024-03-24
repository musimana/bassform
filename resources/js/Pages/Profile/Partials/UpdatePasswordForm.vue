<script setup>
import AppButton from '@/Components/Controls/Buttons/AppButton.vue'
import FormInput from '@/Components/Forms/FormInput.vue'
import InputText from '@/Components/Forms/Inputs/InputText.vue'
import { useForm } from '@inertiajs/vue3'
import { ref } from 'vue'

const passwordInput = ref(null)
const currentPasswordInput = ref(null)

const form = useForm({
  current_password: '',
  password: '',
  password_confirmation: '',
})

const updatePassword = () => {
  form.patch(route('profile.password.update'), {
    preserveScroll: true,
    onSuccess: () => form.reset(),
    onError: () => {
      if (form.errors.password) {
        form.reset('password', 'password_confirmation')
        passwordInput.value.focus()
      }
      if (form.errors.current_password) {
        form.reset('current_password')
        currentPasswordInput.value.focus()
      }
    },
  })
}

</script>

<template>
  <section>
    <header>
      <h3 class="font-semibold text-sm text-gray-900 dark:text-gray-100 uppercase tracking-widest">
        Update Password
      </h3>

      <p class="text-gray-600 dark:text-gray-400 text-xs leading-relaxed">
        Ensure your account is using a long, random password to stay secure.
      </p>
    </header>

    <form @submit.prevent="updatePassword" class="mx-auto mt-6 max-w-xl">
      <FormInput
        input-label="Current Password"
        input-field="current_password"
        input-slot-classes="w-full mb-4"
        :parent-form="form"
      >
        <InputText
          id="current_password"
          name="current_password"
          ref="currentPasswordInput"
          input-type="password"
          class="my-1 block w-full"
          v-model="form.current_password"
          autocomplete="current-password"
        />
      </FormInput>

      <FormInput
        input-label="New Password"
        input-field="password"
        input-slot-classes="w-full mb-4"
        :parent-form="form"
      >
        <InputText
          id="password"
          name="password"
          ref="passwordInput"
          input-type="password"
          class="my-1 block w-full"
          v-model="form.password"
          autocomplete="new-password"
        />
      </FormInput>

      <FormInput
        input-label="Confirm Password"
        input-field="password_confirmation"
        input-slot-classes="w-full mb-6"
        :parent-form="form"
      >
        <InputText
          id="password_confirmation"
          name="password_confirmation"
          ref="passwordInput"
          input-type="password"
          class="my-1 block w-full"
          v-model="form.password_confirmation"
          autocomplete="new-password"
        />
      </FormInput>

      <div class="flex items-center gap-4 justify-end">
        <AppButton :disabled="form.processing">Save</AppButton>

        <Transition
          enter-active-class="transition ease-in-out"
          enter-from-class="opacity-0"
          leave-active-class="transition ease-in-out"
          leave-to-class="opacity-0"
        >
          <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
        </Transition>
      </div>
    </form>
  </section>
</template>
