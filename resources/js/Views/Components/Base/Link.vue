<template>
    <inertia-link @click="$emit('clicked')" :href="href" class="text-indigo-500 underline-none hover:text-indigo-600 hover:underline-none focus:text-indigo-600 focus:underline-none active:text-indigo-700 active:underline-none transition ease-in-out duration-150"><slot></slot></inertia-link>
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
