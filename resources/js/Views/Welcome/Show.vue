<template>
    <guest-layout>
        <div>
            <p>
                <span class="font-semibold">{{ config('app.name') }}</span> checks complete!
            </p>

            <div class="mt-6">
                <div class="space-x-6">
                    <app-link :href="route('register')">Register</app-link>
                    <app-link :href="route('login')">Login</app-link>
                </div>
            </div>
        </div>
    </guest-layout>
</template>

<script>
import GuestLayout from '@/Views/Layouts/GuestLayout';
import AppLink from '@/Views/Components/Base/Link';

export default {
    components: {
        GuestLayout,
        AppLink
    }
};
</script>
