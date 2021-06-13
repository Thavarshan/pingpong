<template>
    <div v-if="links.length > 3" class="mt-12 mb-6 flex items-center justify-between">
        <div class="flex-1 flex items-center justify-center">
            <div>
                <nav class="relative z-0 inline-flex rounded-xl shadow-sm -space-x-px border-t border-b border-gray-200 overflow-hidden" aria-label="Pagination">
                    <div v-for="(link, key) in links" :key="key">
                        <span  v-if="link.url === null" class="relative inline-flex items-center px-4 py-2 bg-white text-sm font-medium text-gray-700 border-l border-r border-gray-200" :class="{ 'bg-gray-100': link.active }">
                            <pagination-link :link="link"></pagination-link>
                        </span>

                        <app-link v-else :href="link.url" class="relative inline-flex items-center px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 border-r border-l border-gray-200" :class="{ 'bg-gray-100': link.active }">
                            <pagination-link :link="link"></pagination-link>
                        </app-link>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</template>

<script>
import AppLink from '@/Views/Components/Base/Link';
import PaginationLink from './PaginationLink';

export default {
    components: {
        AppLink,
        PaginationLink
    },

    props: {
        links: Array,
    },
}
</script>
