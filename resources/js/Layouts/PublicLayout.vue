<script setup>
import AppNavbar from '@/Components/Navs/Navbars/AppNavbar.vue'
import AppBody from '@/Components/Sections/AppBody.vue'
import AppFooter from '@/Components/Sections/AppFooter.vue'
import AppMainContent from '@/Components/Sections/AppMainContent.vue'
import AppPanel from '@/Components/Sections/AppPanel.vue'
</script>

<template>
    <AppBody>
        <AppNavbar v-if="$page.props.metadata?.canLogin" />

        <AppMainContent>
            <AppPanel>
                <slot />
            </AppPanel>
        </AppMainContent>

        <AppFooter />
    </AppBody>
</template>
