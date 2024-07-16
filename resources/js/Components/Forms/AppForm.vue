<script setup>
const emit = defineEmits(['success'])

const props = defineProps({
  endpoint: {
    type: String,
    required: true,
  },
  method: {
    type: String,
    default: 'post',
  },
  form: {
    type: Object,
    required: true,
  },
})

const submit = () => {
  if (props.method === 'patch') {
    props.form.patch(props.endpoint, {
      preserveScroll: true,
      onSuccess: () => emit('success'),
    })
  } else {
    props.form.post(props.endpoint, {
      preserveScroll: true,
      onSuccess: () => emit('success'),
    })
  }
}

</script>

<template>
  <form @submit.prevent="submit">
    <slot />
  </form>
</template>
