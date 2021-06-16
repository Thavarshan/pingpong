<template>
    <div class="bg-gradient-to-br from-indigo-700 to-indigo-500 h-full p-10">
        <div>
            <logo :title="config('app.name')" classes="h-8 w-auto text-indigo-300"></logo>
        </div>

        <div class="mt-10 max-w-xs">
            <div>
                <h6 class="text-white font-bold">Get started quickly</h6>

                <p class="text-indigo-100 text-sm">
                    Vivamus pretium, augue sed bibendum placerat, leo ex ornare mauris, eget efficitur leo ex nec odio.
                </p>
            </div>

            <div class="mt-6">
                <h6 class="text-white font-bold">Support any business model</h6>

                <p class="text-indigo-100 text-sm">
                    Suspendisse urna mauris, auctor quis ornare ac, pharetra et ipsum. Sed ac semper est convallis ex ut.
                </p>
            </div>

            <div class="mt-6">
                <h6 class="text-white font-bold">Join millions of businesses</h6>

                <p class="text-indigo-100 text-sm">
                    Donec semper lorem at felis lacinia auctor sed consectetur nulla justo.
                </p>
            </div>
        </div>
    </div>
</template>

<script>
import Logo from '@/Views/Components/Logos/Logo';

export default {
    components: {
        Logo
    },
}
</script>
