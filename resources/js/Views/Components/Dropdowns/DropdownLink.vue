<template>
    <inertia-link @click="$emit('clicked')" class="block px-4 py-1 rounded-lg leading-6 block text-gray-600 hover:text-gray-600 focus:text-white focus:outline-none active:text-white hover:bg-gray-100 focus:bg-blue-500 active:bg-blue-600 focus:outline-none transition ease-in-out duration-150" :href="href">
        <span class="font-semibold text-sm"><slot></slot></span>
    </inertia-link>
</template>

<script>
export default {
    emits: ['clicked'],

    props: {
        href: {
            type: String,
            required: true
        }
    }
};
</script>
