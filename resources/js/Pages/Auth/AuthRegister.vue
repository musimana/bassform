<script setup>
import AppHead from '@/Components/Sections/AppHead.vue'
import LayoutAuth from '@/Layouts/LayoutAuth.vue'
import InputError from '@/Components/Forms/Inputs/InputError.vue'
import InputLabel from '@/Components/Forms/Inputs/InputLabel.vue'
import AppButton from '@/Components/Navs/Buttons/AppButton.vue'
import InputText from '@/Components/Forms/Inputs/InputText.vue'
import { Link, useForm } from '@inertiajs/vue3'

defineProps({
  content: {
    type: Object,
    required: true,
  },
  metadata: {
    type: Object,
    required: true,
  },
})

const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
})

const submit = () => {
  form.post(route('register'), {
    onFinish: () => form.reset('password', 'password_confirmation'),
  })
}

</script>

<template>
  <LayoutAuth>
    <AppHead :metadata="metadata" />

    <form @submit.prevent="submit">
      <div>
        <InputLabel for="name" value="Name" />

        <InputText
          id="name"
          type="text"
          class="mt-1 block w-full"
          v-model="form.name"
          required
          autofocus
          autocomplete="name"
        />

        <InputError class="mt-2" :message="form.errors.name" />
      </div>

      <div class="mt-4">
        <InputLabel for="email" value="Email" />

        <InputText
          id="email"
          type="email"
          class="mt-1 block w-full"
          v-model="form.email"
          required
          autocomplete="username"
        />

        <InputError class="mt-2" :message="form.errors.email" />
      </div>

      <div class="mt-4">
        <InputLabel for="password" value="Password" />

        <InputText
          id="password"
          type="password"
          class="mt-1 block w-full"
          v-model="form.password"
          required
          autocomplete="new-password"
        />

        <InputError class="mt-2" :message="form.errors.password" />
      </div>

      <div class="mt-4">
        <InputLabel for="password_confirmation" value="Confirm Password" />

        <InputText
          id="password_confirmation"
          type="password"
          class="mt-1 block w-full"
          v-model="form.password_confirmation"
          required
          autocomplete="new-password"
        />

        <InputError class="mt-2" :message="form.errors.password_confirmation" />
      </div>

      <div class="flex items-center justify-end mt-4">
        <Link
          :href="route('login')"
          class="underline text-sm text-gray-500 hover:text-gray-900 dark:hover:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-200"
        >Already registered?</Link>

        <AppButton
          custom-classes="app-button-primary-gray-900 ms-4"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >Register</AppButton>
      </div>
    </form>
  </LayoutAuth>
</template>
