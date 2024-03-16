<script setup>
import AppSectionDivider from '@/Components/Sections/AppSectionDivider.vue'
import ControlDarkMode from '@/Components/Controls/ControlDarkMode.vue'
import NavbarMobileItems from '@/Components/Controls/Navbars/NavbarMobileItems.vue'
import NavbarMobileLogin from '@/Components/Controls/Navbars/NavbarMobileLogin.vue'
import NavbarMobileUser from '@/Components/Controls/Navbars/NavbarMobileUser.vue'

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
      class="lg:hidden absolute top-20 z-50 w-full -mt-1 border-y dark:border-t border-gray-900 dark:border-gray-100 px-3 py-4 bg-gray-200 dark:bg-gray-600 dark:bg-gradient-to-bl from-gray-700 via-transparent"
      :class="{ block: props.showingNavbarMobile, hidden: !props.showingNavbarMobile }"
    >
      <NavbarMobileItems />

      <div class="px-3 pb-4 space-y-1">
        <AppSectionDivider v-if="$page.props.metadata.navbarMobile.length" />

        <NavbarMobileUser v-if="$page.props.auth.user" />

        <NavbarMobileLogin v-else-if="$page.props.metadata.canLogin || $page.props.metadata.canRegister" />
      </div>
    </div>
  </Teleport>
</template>
