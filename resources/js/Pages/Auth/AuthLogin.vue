<script setup>
import AppButton from '@/Components/Controls/Buttons/AppButton.vue'
import FormInput from '@/Components/Forms/FormInput.vue'
import InputCheckbox from '@/Components/Forms/Inputs/InputCheckbox.vue'
import InputText from '@/Components/Forms/Inputs/InputText.vue'
import LayoutAuth from '@/Layouts/LayoutAuth.vue'
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
    <div v-if="metadata.status" class="mb-4 font-medium text-sm text-green-600">
      {{ metadata.status }}
    </div>

    <form @submit.prevent="submit">
      <FormInput
        input-label="Email"
        input-field="email"
        input-slot-classes="w-full mb-4"
        :parent-form="form"
      >
        <InputText
          id="email"
          name="email"
          input-type="email"
          class="my-1 block w-full"
          v-model="form.email"
          autofocus
          autocomplete="username"
        />
      </FormInput>

      <FormInput
        input-label="Password"
        input-field="password"
        :parent-form="form"
      >
        <InputText
          id="password"
          name="password"
          input-type="password"
          class="my-1 block w-full"
          v-model="form.password"
          autocomplete="current-password"
        />
      </FormInput>

      <div class="mt-4 flex">
        <label class="flex items-center">
          <InputCheckbox name="remember" v-model:checked="form.remember" />

          <span class="ms-2 text-sm text-gray-500">Remember me</span>
        </label>
      </div>

      <div class="flex items-center justify-end mt-4 gap-x-4">
        <Link
          v-if="metadata.canResetPassword"
          :href="route('password.request')"
          class="underline text-sm text-gray-500 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-100"
        >Forgot your password?</Link>

        <AppButton
          id="button-login"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >Login</AppButton>
      </div>
    </form>
  </LayoutAuth>
</template>
