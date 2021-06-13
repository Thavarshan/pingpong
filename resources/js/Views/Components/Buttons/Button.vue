<template>
    <inertia-link v-if="link" @click="$emit('clicked')" :href="href" class="inline-flex shadow items-center justify-center whitespace-no-wrap px-4 py-2 border border-transparent rounded-xl focus:outline-none focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150" :class="colors">
        <span class="font-semibold text-sm whitespace-no-wrap block">
            <slot></slot>
        </span>
    </inertia-link>

    <button v-else @click="$emit('clicked')" :disabled="loading" class="inline-flex shadow items-center justify-center whitespace-no-wrap px-4 py-2 border border-transparent rounded-xl focus:outline-none focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150" :class="colors">
        <svg v-show="loading" class="inline animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>

        <span class="font-semibold text-sm whitespace-no-wrap block">
            <slot></slot>
        </span>
    </button>
</template>

<script>
export default {
    emits: ['clicked'],

    props: {
        mode: {
            type: String,
            required: false,
            default: 'primary',
        },

        loading: {
            type: Boolean,
            default: false
        },

        link: {
            type: Boolean,
            default: false
        },

        href: String
    },

    computed: {
        colors() {
            if (this.mode === 'primary') {
                return 'text-white hover:text-white focus:text-white active:text-white bg-gray-800 hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900';
            } else if (this.mode === 'danger') {
                return 'text-white hover:text-white focus:text-white active:text-white bg-red-600 hover:bg-red-700 focus:bg-red-700 active:bg-red-800';
            } else {
                return 'text-gray-600 hover:text-gray-600 focus:text-gray-600 active:text-gray-600 bg-white hover:bg-gray-100 focus:bg-gray-100 active:bg-gray-200 border border-gray-100';
            }
        }
    }
}
</script>
