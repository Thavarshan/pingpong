<template>
    <inertia-link @click="$emit('clicked')" :href="href" class="text-gray-800 underline hover:text-gray-700 hover:underline focus:text-gray-700 focus:underline active:text-gray-900 active:underline transition ease-in-out duration-150"><slot></slot></inertia-link>
</template>

<script>
export default {
    emits: ['clicked'],

    props: {
        href: {
            required: true,
            type: String
        }
    }
}
</script>
