<template>
    <auth-layout>
        <template #left>
            <advertisement></advertisement>
        </template>

        <template #right>
            <div class="max-w-sm">
                <div>
                    <div class="mb-6 block lg:hidden">
                        <logo :title="config('app.name')" classes="h-20 w-20"></logo>
                    </div>

                    <h4 class="mt-6 font-semibold text-xl text-gray-800">Verify your email address</h4>

                    <div class="mt-3 font-normal text-base text-gray-500">
                        Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.
                    </div>

                    <div class="mt-3 font-medium text-base text-gray-500" v-if="verificationLinkSent" >
                        A new verification link has been sent to the email address you provided during registration.
                    </div>
                </div>

                <div class="mt-6">
                    <form @submit.prevent="verify" class="w-full">
                        <div class="mt-6 flex items-center justify-between">
                            <app-button type="submit" mode="primary" :class="{ 'opacity-25': form.processing }" :loading="form.processing">
                                Resend verification email
                            </app-button>

                            <inertia-link :href="route('logout')" method="post" as="button" class="text-blue-500 no-underline hover:text-blue-600 hover:no-underline focus:text-blue-600 focus:no-underline active:text-gray-600 active:no-underline transition ease-in-out duration-150">Sign out</inertia-link>
                        </div>
                    </form>
                </div>
            </div>
        </template>
    </auth-layout>
</template>

<script>
import AuthLayout from '@/Views/Layouts/AuthLayout';
import Logo from '@/Views/Components/Logos/Logo';
import AppButton from '@/Views/Components/Buttons/Button';
import Advertisement from './Advertisement.vue';

export default {
    props: {
        status: String
    },

    components: {
        AuthLayout,
        Logo,
        AppButton,
        Advertisement
    },

    data() {
        return {
            form: this.$inertia.form(),
        }
    },

    methods: {
        verify() {
            this.form.post(this.route('verification.send'))
        },
    },

    computed: {
        verificationLinkSent() {
            return this.status === 'verification-link-sent';
        }
    }
};
</script>
