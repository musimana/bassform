<script setup>
import AppButton from '@/Components/Controls/Buttons/AppButton.vue'
import FormInput from '@/Components/Forms/FormInput.vue'
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
    <form @submit.prevent="submit">
      <FormInput
        input-label="Name"
        input-field="name"
        input-slot-classes="w-full mb-4"
        :parent-form="form"
      >
        <InputText
          id="name"
          name="name"
          class="my-1 block w-full"
          v-model="form.name"
          autofocus
          autocomplete="name"
        />
      </FormInput>

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
          autocomplete="username"
        />
      </FormInput>

      <FormInput
        input-label="Password"
        input-field="password"
        input-slot-classes="w-full mb-4"
        :parent-form="form"
      >
        <InputText
          id="password"
          name="password"
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
          input-type="password"
          class="my-1 block w-full"
          v-model="form.password_confirmation"
          autocomplete="new-password"
        />
      </FormInput>

      <div class="flex items-center justify-end mt-4 gap-x-4">
        <Link
          :href="route('login')"
          class="underline text-sm text-gray-500 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-100"
        >Already registered?</Link>

        <AppButton
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >Register</AppButton>
      </div>
    </form>
  </LayoutAuth>
</template>
