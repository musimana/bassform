<script setup>
import AppButton from '@/Components/Controls/Buttons/AppButton.vue'
import FormInput from '@/Components/Forms/FormInput.vue'
import InputText from '@/Components/Forms/Inputs/InputText.vue'
import LayoutAuth from '@/Layouts/LayoutAuth.vue'
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
    <div class="mb-4 text-sm text-gray-500">
      This is a secure area of the application. Please confirm your password before continuing.
    </div>

    <form @submit.prevent="submit">
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
          autofocus
        />
      </FormInput>

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
