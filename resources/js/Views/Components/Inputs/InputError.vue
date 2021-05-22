<template>
    <transition enter-active-class="transition ease-out duration-500" enter-class="transform opacity-0" enter-to-class="transform opacity-100">
        <div class="mt-2" v-show="message">
            <p class="font-semibold text-xs text-red-500 m-0 p-0">{{ message }}</p>
        </div>
    </transition>
</template>

<script>
export default {
    props: {
        message: String
    }
}
</script>
