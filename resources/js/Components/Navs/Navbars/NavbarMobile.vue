<script setup>
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
      class="lg:hidden absolute top-20 z-50 w-full -mt-1 border-t border-gray-900 dark:border-white px-3 py-4 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl from-gray-700 via-transparent"
      :class="{ block: props.showingNavbarMobile, hidden: !props.showingNavbarMobile }"
    >
      <NavbarMobileItems />

      <div v-if="$page.props.metadata.canLogin || $page.props.metadata.canRegister || $page.props.auth.user" class="px-3 pb-4 space-y-1">
        <hr class="mt-4 mb-8" />

        <NavbarMobileUser v-if="$page.props.auth.user" />

        <NavbarMobileLogin v-else-if="$page.props.metadata.canLogin || $page.props.metadata.canRegister" />
      </div>
    </div>
  </Teleport>
</template>
