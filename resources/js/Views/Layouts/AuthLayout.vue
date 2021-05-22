<template>
    <div class="md:grid md:grid-cols-12 min-h-screen min-w-full overflow-x-hidden">
        <div class="col-span-4 hidden lg:block h-full">
            <slot name="left"></slot>
        </div>

        <div class="col-span-full lg:col-span-8 h-full flex justify-center items-center p-8">
            <slot name="right"></slot>
        </div>
    </div>
</template>

<script>
export default {
    //
}
</script>
