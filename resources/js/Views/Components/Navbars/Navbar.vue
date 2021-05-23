<template>
    <nav>
        <div class="container mx-auto px-4 sm:px-6">
            <div class="flex items-center justify-between h-16">
                <div class="leading-none w-auto">
                    <!-- Logo -->
                    <slot name="logo"></slot>
                </div>

                <div class="ml-8 flex flex-1 items-center">
                    <div class="hidden md:flex items-center mr-auto space-x-4">
                        <!-- Links Left -->
                        <slot name="linksleft"></slot>
                    </div>

                    <div class="flex items-center ml-auto space-x-4">
                        <!-- Links Right -->
                        <slot name="linksright"></slot>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    //
}
</script>
