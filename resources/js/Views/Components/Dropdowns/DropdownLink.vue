<template>
    <inertia-link @click="$emit('clicked')" class="block px-4 py-1 rounded-lg leading-6 block hover:text-gray-600 focus:text-gray-800 focus:outline-none hover:bg-gray-100 focus:bg-gray-100 focus:outline-none active:text-white active:bg-gray-100 transition ease-in-out duration-150" :href="href">
        <span class="text-sm" :class="classes"><slot></slot></span>
    </inertia-link>
</template>

<script>
export default {
    emits: ['clicked'],

    props: {
        href: {
            type: String,
            required: true
        },

        active: {
            type: Boolean,
            default: false
        }
    },

    computed: {
        classes() {
            return this.active
                ? 'font-bold text-gray-800'
                : 'font-semibold text-gray-500';
        }
    }
};
</script>
