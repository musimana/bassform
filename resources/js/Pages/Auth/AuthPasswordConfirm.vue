<script setup>
import AppHead from '@/Components/Sections/AppHead.vue'
import LayoutAuth from '@/Layouts/LayoutAuth.vue'
import InputError from '@/Components/Forms/Inputs/InputError.vue'
import InputLabel from '@/Components/Forms/Inputs/InputLabel.vue'
import AppButton from '@/Components/Controls/Buttons/AppButton.vue'
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
  password: '',
})

const submit = () => {
  form.post(route('password.confirm'), {
    onFinish: () => form.reset(),
  })
}

</script>

<template>
  <LayoutAuth>
    <AppHead :metadata="metadata" />

    <div class="mb-4 text-sm text-gray-500">
      This is a secure area of the application. Please confirm your password before continuing.
    </div>

    <form @submit.prevent="submit">
      <div>
        <InputLabel for="password" value="Password" />

        <InputText
            id="password"
            type="password"
            class="mt-1 block w-full"
            v-model="form.password"
            required
            autocomplete="current-password"
            autofocus
        />

        <InputError class="mt-2" :message="form.errors.password" />
      </div>

      <div class="flex justify-end mt-4">
        <AppButton
          custom-classes="app-button-primary-gray-900 ms-4"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >Confirm</AppButton>
      </div>
    </form>
  </LayoutAuth>
</template>
