<script setup>
import AppButton from '@/Components/Controls/Buttons/AppButton.vue'
import FormInput from '@/Components/Forms/FormInput.vue'
import InputText from '@/Components/Forms/Inputs/InputText.vue'
import LayoutAuth from '@/Layouts/LayoutAuth.vue'
import { useForm } from '@inertiajs/vue3'

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

const form = useForm({
  token: props.metadata.token,
  email: props.metadata.email,
  password: '',
  password_confirmation: '',
})

const submit = () => {
  form.post(route('password.store'), {
    onFinish: () => form.reset('password', 'password_confirmation'),
  })
}

</script>

<template>
  <LayoutAuth>
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
        input-slot-classes="w-full mb-4"
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

      <div class="flex items-center justify-end">
        <AppButton
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
          min-width="lg"
        >Reset Password</AppButton>
      </div>
    </form>
  </LayoutAuth>
</template>
