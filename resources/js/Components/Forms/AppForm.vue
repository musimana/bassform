<script setup>
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
  endpoint: String,
  form: Object,
})

const form = useForm(props.form)

const submit = () => {
  form.post(props.endpoint, {
    preserveScroll: true,
    onSuccess: () => form.reset(),
  })
}

</script>

<template>
  <form @submit.prevent="submit">
    <slot />
  </form>
</template>
