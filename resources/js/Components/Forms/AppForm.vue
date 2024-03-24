<script setup>
const props = defineProps({
  endpoint: {
    type: String,
    required: true,
  },
  form: {
    type: Object,
    required: true,
  },
})

const submit = () => {
  props.form.post(props.endpoint, {
    preserveScroll: true,
    onSuccess: () => props.form.reset(),
  })
}

</script>

<template>
  <form @submit.prevent="submit">
    <slot />
  </form>
</template>
