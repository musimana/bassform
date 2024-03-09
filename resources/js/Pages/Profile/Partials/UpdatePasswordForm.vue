<script setup>
import InputError from '@/Components/Forms/Inputs/InputError.vue'
import InputLabel from '@/Components/Forms/Inputs/InputLabel.vue'
import AppButton from '@/Components/Controls/Buttons/AppButton.vue'
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

    <form @submit.prevent="updatePassword" class="mx-auto mt-6 space-y-6 max-w-xl">
      <div>
        <InputLabel for="current_password" value="Current Password" />

        <InputText
          id="current_password"
          ref="currentPasswordInput"
          v-model="form.current_password"
          type="password"
          class="mt-1 block w-full"
          autocomplete="current-password"
        />

        <InputError :message="form.errors.current_password" class="mt-2" />
      </div>

      <div>
        <InputLabel for="password" value="New Password" />

        <InputText
            id="password"
            ref="passwordInput"
            v-model="form.password"
            type="password"
            class="mt-1 block w-full"
            autocomplete="new-password"
        />

        <InputError :message="form.errors.password" class="mt-2" />
      </div>

      <div>
        <InputLabel for="password_confirmation" value="Confirm Password" />

        <InputText
          id="password_confirmation"
          v-model="form.password_confirmation"
          type="password"
          class="mt-1 block w-full"
          autocomplete="new-password"
        />

        <InputError :message="form.errors.password_confirmation" class="mt-2" />
      </div>

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
