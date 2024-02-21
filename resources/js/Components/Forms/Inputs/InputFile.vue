<script setup>
import { onMounted, ref } from 'vue';

defineProps({
    inputId: {
        type: String,
        default: 'file-input',
    },
    modelValue: {
        type: Object,
        default: () => ({}),
    },
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input
        :id="inputId"
        :name="inputId"
        class="w-full md:w-4/5 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
        ref="input"
        type="file"
        @input="$emit('update:modelValue', $event.target.files[0])"
    />
</template>
