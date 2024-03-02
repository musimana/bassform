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
    default: 'py-1',
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
    24: 'w-24',
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
  <div class="dropdown relative h-8" @mouseover="open = true" @mouseleave="open = false">
    <slot name="trigger" />

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
        class="dropdown-content hidden absolute z-50 pt-[26px] shadow-lg"
        :class="[widthClass, alignmentClasses]"
      >
        <div class="-mr-1 bg-gray-100 dark:bg-gray-600 shadow-2xl shadow-gray-500/20 dark:shadow-none ring-1 ring-gray-950/5 dark:ring-gray-100/5" :class="contentClasses">
          <slot name="content" />
        </div>
      </div>
    </Transition>
  </div>
</template>

<style scoped>
.dropdown:hover .dropdown-content {
  display: block;
}
</style>
