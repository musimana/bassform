<script setup>
import AppHead from '@/Components/Sections/AppHead.vue'
import InputCheckbox from '@/Components/Forms/Inputs/InputCheckbox.vue'
import LayoutAuth from '@/Layouts/LayoutAuth.vue'
import InputError from '@/Components/Forms/Inputs/InputError.vue'
import InputLabel from '@/Components/Forms/Inputs/InputLabel.vue'
import AppButton from '@/Components/Controls/Buttons/AppButton.vue'
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
  email: '',
  password: '',
  remember: false,
})

const submit = () => {
  form.post(route('login'), {
    onFinish: () => form.reset('password'),
  })
}

</script>

<template>
  <LayoutAuth>
    <AppHead :metadata="metadata" />

    <div v-if="metadata.status" class="mb-4 font-medium text-sm text-green-600">
      {{ metadata.status }}
    </div>

    <form @submit.prevent="submit">
      <div>
        <InputLabel for="email" value="Email" />

        <InputText
          id="email"
          name="email"
          type="email"
          class="mt-1 block w-full"
          v-model="form.email"
          required
          autofocus
          autocomplete="username"
        />

        <InputError class="mt-2" :message="form.errors.email" />
      </div>

      <div class="mt-4">
        <InputLabel for="password" value="Password" />

        <InputText
          id="password"
          name="password"
          type="password"
          class="mt-1 block w-full"
          v-model="form.password"
          required
          autocomplete="current-password"
        />

        <InputError class="mt-2" :message="form.errors.password" />
      </div>

      <div class="mt-4 flex">
        <label class="flex items-center">
          <InputCheckbox name="remember" v-model:checked="form.remember" />

          <span class="ms-2 text-sm text-gray-500">Remember me</span>
        </label>
      </div>

      <div class="flex items-center justify-end mt-4">
        <Link
          v-if="metadata.canResetPassword"
          :href="route('password.request')"
          class="underline text-sm text-gray-500 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-100"
        >Forgot your password?</Link>

        <AppButton
          id="button-login"
          custom-classes="app-button-primary-gray-900 ms-4"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >Login</AppButton>
      </div>
    </form>
  </LayoutAuth>
</template>
