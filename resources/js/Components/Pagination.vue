<template>
    <nav v-if="links.length > 1" class="flex flex-wrap justify-center mt-4">
        <template v-for="(link, key) in links" :key="key">
            <div
                v-if="!link.url"
                class="mr-1 mb-1 px-4 py-2 text-sm leading-4 text-gray-400 border rounded cursor-not-allowed"
                v-html="link.label"
                aria-disabled="true"
            />
            <Link
                v-else
                :href="link.url"
                preserve-scroll
                class="mr-1 mb-1 px-4 py-2 text-sm border rounded hover:bg-gray-200"
                :class="{ 'bg-gray-800 text-white': link.active }"
                v-html="link.label"
                aria-disabled="false"
            />
        </template>
    </nav>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
    links: {
        type: Array,
        required: true,
    },
})
</script>
