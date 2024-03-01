<script setup>
import ControlDarkMode from '@/Components/Navs/ControlDarkMode.vue'
import NavbarMobileItems from '@/Components/Navs/Navbars/NavbarMobileItems.vue'
import NavbarMobileLogin from '@/Components/Navs/Navbars/NavbarMobileLogin.vue'
import NavbarMobileUser from '@/Components/Navs/Navbars/NavbarMobileUser.vue'

const props = defineProps({
  showingNavbarMobile: {
    type: Boolean,
    required: true,
  },
})

</script>

<template>
  <Teleport to="body">
    <div
      class="lg:hidden absolute top-20 z-50 w-full -mt-1 border-t border-gray-900 dark:border-gray-100 px-3 py-4 bg-gray-100 dark:bg-gray-600 dark:bg-gradient-to-bl from-gray-700 via-transparent"
      :class="{ block: props.showingNavbarMobile, hidden: !props.showingNavbarMobile }"
    >
      <NavbarMobileItems />

      <div class="px-3 pb-4 space-y-1">
        <hr class="mt-4 mb-8" />

        <ControlDarkMode custom-classes="block w-full ps-3 pe-4 py-2 border-l-4 border-transparent items-start text-base font-semibold text-gray-600 hover:text-gray-600 dark:text-gray-400 dark:hover:text-gray-200 hover:border-gray-600 dark:hover:border-gray-200 focus:outline focus:outline-2 focus:rounded-sm focus:outline-gray-100 transition duration-150 ease-in-out" />

        <NavbarMobileUser v-if="$page.props.auth.user" />

        <NavbarMobileLogin v-else-if="$page.props.metadata.canLogin || $page.props.metadata.canRegister" />
      </div>
    </div>
  </Teleport>
</template>
