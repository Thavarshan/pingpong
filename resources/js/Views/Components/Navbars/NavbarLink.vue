<template>
    <inertia-link :href="href" @click="$emit('clicked')" class="px-3 py-1.5 rounded-xl hover:bg-opacity-75 focus:bg-opacity-100 hover:opacity-100 focus:outline-none transition ease-in-out duration-150 ml-2" :class="classes">
        <span class="font-semibold text-sm">
            <!-- Link Text -->
            <slot></slot>
        </span>
    </inertia-link>
</template>

<script>
export default {
    emits: ['clicked'],

    props: {
        href: String,

        active: {
            type: Boolean,
            default: false
        }
    },

    computed: {
        classes() {
            return this.active
                ? 'opacity-100 bg-opacity-100'
                : 'opacity-75 bg-opacity-0'
        }
    }
}
</script>
