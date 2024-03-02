<script setup>
import { computed } from 'vue'
import AppHead from '@/Components/Sections/AppHead.vue'
import LayoutAuth from '@/Layouts/LayoutAuth.vue'
import AppButton from '@/Components/Navs/Buttons/AppButton.vue'
import { Link, useForm } from '@inertiajs/vue3'

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

const form = useForm({})

const submit = () => {
  form.post(route('verification.send'))
}

const verificationLinkSent = computed(() => props.metadata.status === 'verification-link-sent')

</script>

<template>
  <LayoutAuth>
    <AppHead :metadata="metadata" />

    <div class="mb-4 text-sm text-gray-600">
      Thanks for signing up! Before getting started, could you verify your email address by clicking on the link
      we just emailed to you? If you didn't receive the email, we will gladly send you another.
    </div>

    <div class="mb-4 font-medium text-sm text-green-600" v-if="verificationLinkSent">
      A new verification link has been sent to the email address you provided during registration.
    </div>

    <form @submit.prevent="submit">
      <div class="mt-4 flex items-center justify-between">
        <AppButton
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >Resend Verification Email</AppButton>

        <Link
          :href="route('logout')"
          method="post"
          as="button"
          class="underline text-sm text-gray-500 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-100"
        >Log Out</Link>
      </div>
    </form>
  </LayoutAuth>
</template>
