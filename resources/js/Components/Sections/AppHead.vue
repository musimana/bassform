<script setup>
import { Head } from '@inertiajs/vue3'

defineProps({
  metadata: {
    type: Object,
    default: () => (
      {
        description: '',
        keywords: '',
        openGraphImage: '',
        title: '',
        twitterCardImage: '',
      }
    ),
  },
})
</script>

<template>
  <Head :title="metadata.title">
    <meta v-if="metadata?.description && metadata.description !== ''" name="description" :content="metadata.description" />
    <meta v-if="metadata?.canonical && metadata.canonical !== ''" name="canonical" :content="metadata.canonical" />
    <meta v-if="metadata?.keywords && metadata.keywords !== ''" name="keywords" :content="metadata.keywords" />

    <meta v-if="metadata?.openGraphImage && metadata.openGraphImage !== ''" property="og:image" :content="metadata.openGraphImage" />
    <meta v-if="metadata?.openGraphImage && metadata.openGraphImage !== ''" property="og:title" :content="metadata.title" />
    <meta v-if="metadata?.openGraphImage && metadata.openGraphImage !== ''" property="og:description" :content="metadata.description" />
    <meta v-if="metadata?.openGraphImage && metadata.openGraphImage !== ''" property="og:image:width" content="1200" />
    <meta v-if="metadata?.openGraphImage && metadata.openGraphImage !== ''" property="og:image:height" content="630" />

    <meta v-if="metadata?.twitterCardImage && metadata.twitterCardImage !== ''" name="twitter:card" content="summary_large_image" />
    <meta v-if="metadata?.twitterCardImage && metadata.twitterCardImage !== ''" name="twitter:title" :content="metadata.title" />
    <meta v-if="metadata?.twitterCardImage && metadata.twitterCardImage !== ''" name="twitter:description" :content="metadata.description" />
    <meta v-if="metadata?.twitterCardImage && metadata.twitterCardImage !== ''" name="twitter:image" :content="metadata.twitterCardImage" />

    <slot />
  </Head>
</template>
