<script setup>
import IconGithub from '@/Components/Icons/IconGithub.vue'
</script>

<template>
    <footer class="absolute bottom-0 flex w-full m-auto p-4 items-center justify-between">
        <div class="w-1/2 text-sm text-gray-800 dark:text-gray-300 text-start">
            <div v-if="$page.props.metadata?.copyright" class="flex items-center gap-2">
                {{ $page.props.metadata.copyright }}
            </div>
        </div>

        <div class="w-1/2 text-sm text-gray-800 dark:text-gray-300 text-end">
            <nav v-if="$page.props.metadata?.github" class="flex justify-end items-center gap-2">
                <a :href="$page.props.metadata.github" title="Github Profile" target="_blank" rel="noopener noreferrer">
                    <IconGithub class="w-6 h-6 fill-gray-800 dark:fill-gray-300 hover:fill-gray-600 hover:dark:fill-gray-100 cursor-pointer" />
                </a>
            </nav>
        </div>
    </footer>
</template>
