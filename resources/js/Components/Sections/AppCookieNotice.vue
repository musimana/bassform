<script setup>
import AppButton from '@/Components/Controls/Buttons/AppButton.vue'
import InputCheckbox from '@/Components/Forms/Inputs/InputCheckbox.vue'
import { store } from '@/store.js'
import { Link, useForm, usePage } from '@inertiajs/vue3'
import { onBeforeMount } from 'vue'

const form = useForm({ remember: true })

const page = usePage()

const submit = () => {
  form.post(route('cookies.store'), {
    preserveScroll: true,
    onSuccess: () => store.cookies.acknowledged = true,
  })
}

onBeforeMount(() => store.cookies.acknowledged = page.props.cookies.acknowledged)
</script>

<template>
  <div v-if="!store.cookies.acknowledged" class="w-full flex h-20 fixed bottom-0 lg:right-0 z-50 justify-between bg-gray-100 dark:bg-gray-700 dark:bg-gradient-to-bl from-gray-700 via-transparent text-gray-900 dark:text-gray-100 hover:text-gray-600 dark:hover:text-gray-300 dark:ring-1 dark:ring-inset dark:ring-gray-100/5 shadow-2xl shadow-gray-500/20 dark:shadow-none">
    <p class="xl:flex w-1/2 text-gray-600 dark:text-gray-300 text-sm leading-relaxed items-center justify-start my-auto">
      We use necessary cookies to make our site work, you can find out more in our
      <Link class="xl:pl-1 underline" :href="route('privacy')" target="_blank" rel="noopener noreferrer">privacy policy</Link>.
    </p>

    <div class="md:flex lg:w-1/3 xl:w-1/4 items-center justify-end my-auto gap-4">
      <AppButton
        id="button-cookies-acknowledgement"
        class="flex w-full xl:w-1/3 items-center mb-2 md:my-0"
        :class="{ 'opacity-25': form.processing }"
        @click="submit"
        :disabled="form.processing"
      >Accept</AppButton>

      <label class="flex w-full xl:w-2/5 items-center justify-end">
        <InputCheckbox name="remember" v-model:checked="form.remember" />

        <span class="ms-2 text-sm text-gray-600 dark:text-gray-300">Remember my choice</span>
      </label>
    </div>
  </div>
</template>
