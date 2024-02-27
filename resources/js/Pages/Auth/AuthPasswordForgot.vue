<script setup>
import AppHead from '@/Components/Sections/AppHead.vue'
import LayoutAuth from '@/Layouts/LayoutAuth.vue'
import InputError from '@/Components/Forms/Inputs/InputError.vue'
import InputLabel from '@/Components/Forms/Inputs/InputLabel.vue'
import AppButton from '@/Components/Navs/Buttons/AppButton.vue'
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
    <AppHead :metadata="metadata" />

    <div class="mb-4 text-sm text-gray-500">
      Forgot your password? No problem. Just let us know your email address and we will email you a password reset
      link that will allow you to choose a new one.
    </div>

    <div v-if="metadata.status" class="mb-4 font-medium text-sm text-green-600">
      {{ metadata.status }}
    </div>

    <form @submit.prevent="submit">
      <div>
        <InputLabel for="email" value="Email" />

        <InputText
          id="email"
          type="email"
          class="mt-1 block w-full"
          v-model="form.email"
          required
          autofocus
          autocomplete="username"
        />

        <InputError class="mt-2" :message="form.errors.email" />
      </div>

      <div class="flex items-center justify-end mt-4">
        <AppButton
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >Email Password Reset Link</AppButton>
      </div>
    </form>
  </LayoutAuth>
</template>
