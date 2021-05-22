<template>
    <inertia-link @click="$emit('clicked')" :href="href" class="text-blue-500 no-underline hover:text-blue-600 hover:no-underline focus:text-blue-600 focus:no-underline active:text-gray-600 active:no-underline transition ease-in-out duration-150"><slot></slot></inertia-link>
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
