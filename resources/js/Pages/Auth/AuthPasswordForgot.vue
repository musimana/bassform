<script setup>
import AppButton from '@/Components/Controls/Buttons/AppButton.vue'
import FormInput from '@/Components/Forms/FormInput.vue'
import LayoutAuth from '@/Layouts/LayoutAuth.vue'
import InputText from '@/Components/Forms/Inputs/InputText.vue'
import { useForm } from '@inertiajs/vue3'

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
})

const submit = () => {
  form.post(route('password.email'))
}

</script>

<template>
  <LayoutAuth>
    <p class="mb-4 text-sm text-gray-500">
      Forgot your password? No problem. Just let us know your email address and we will email you a password reset
      link that will allow you to choose a new one.
    </p>

    <div v-if="metadata.status" class="mb-4 font-medium text-sm text-green-600">
      {{ metadata.status }}
    </div>

    <form @submit.prevent="submit">
      <FormInput
        input-label="Email"
        input-field="email"
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

      <div class="flex items-center justify-end mt-4">
        <AppButton
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
          min-width="xl"
        >Send Password Reset Link</AppButton>
      </div>
    </form>
  </LayoutAuth>
</template>
