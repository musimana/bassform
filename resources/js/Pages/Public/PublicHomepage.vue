<script setup>
import PublicLayout from '@/Layouts/PublicLayout.vue';
import ContentHomepage from '@/Pages/Public/Partials/ContentHomepage.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    content: {
        type: Object,
        default: () => ({}),
    },
    metadata: {
        type: Object,
        default: () => ({}),
    },
});
</script>

<template>
    <Head :title="metadata?.appName" />

    <PublicLayout>
        <ContentHomepage />
    </PublicLayout>
</template>
