<script setup>
import { computed, onMounted, onUnmounted, ref } from 'vue'

const props = defineProps({
  align: {
    type: String,
    default: 'right',
  },
  width: {
    type: String,
    default: '48',
  },
  contentClasses: {
    type: String,
    default: 'py-1 bg-gray-100',
  },
})

const open = ref(false)

const closeOnEscape = (e) => {
  if (open.value && e.key === 'Escape') {
    open.value = false
  }
}

onMounted(() => document.addEventListener('keydown', closeOnEscape))
onUnmounted(() => document.removeEventListener('keydown', closeOnEscape))

const widthClass = computed(() => {
  return {
    48: 'w-48',
  }[props.width.toString()]
})

const alignmentClasses = computed(() => {
  if (props.align === 'left') {
    return 'ltr:origin-top-left rtl:origin-top-right start-0'
  } else if (props.align === 'right') {
    return 'ltr:origin-top-right rtl:origin-top-left end-0'
  }

  return 'origin-top'
})

</script>

<template>
  <div class="relative">
    <div @click="open = !open">
      <slot name="trigger" />
    </div>

    <!-- Full Screen Dropdown Overlay -->
    <div v-show="open" class="fixed inset-0 z-30" @click="open = false"></div>

    <Transition
      enter-active-class="transition ease-out duration-200"
      enter-from-class="opacity-0 scale-95"
      enter-to-class="opacity-100 scale-100"
      leave-active-class="transition ease-in duration-75"
      leave-from-class="opacity-100 scale-100"
      leave-to-class="opacity-0 scale-95"
    >
      <div
        v-show="open"
        class="absolute z-40 mt-6 shadow-lg"
        :class="[widthClass, alignmentClasses]"
        style="display: none"
        @click="open = false"
      >
        <div class="-mr-1 bg-gray-100 dark:bg-gray-600 shadow-2xl shadow-gray-500/20 dark:shadow-none ring-1 ring-gray-950/5 dark:ring-gray-100/5" :class="contentClasses">
          <slot name="content" />
        </div>
      </div>
    </Transition>
  </div>
</template>
