<template>
    <label class="block" :for="text ? text : null">
        <span class="text-gray-600 text-sm font-semibold">
            <span v-text="text"></span>
        </span>

        <slot></slot>
    </label>
</template>

<script>
export default {
    props: {
        text: String
    }
}
</script>
