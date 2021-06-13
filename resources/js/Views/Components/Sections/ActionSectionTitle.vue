<template>
    <div class="md:col-span-4">
        <div>
            <h3 class="text-lg font-semibold text-gray-900">
                <slot name="title"></slot>
            </h3>

            <p class="mt-1 text-sm text-gray-600">
                <slot name="description"></slot>
            </p>
        </div>
    </div>
</template>

<script>
export default {
    //
}
</script>
