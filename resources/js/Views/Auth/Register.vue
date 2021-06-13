<template>
    <auth-layout>
        <template #left>
            <advertisement></advertisement>
        </template>

        <template #right>
            <div>
                <div>
                    <div class="mb-6 block lg:hidden">
                        <logo :title="config('app.name')" classes="h-20 w-20"></logo>
                    </div>

                    <div>
                        <h4 class="font-semibold text-xl text-gray-800">Create your {{ config('app.name') }} account</h4>

                        <p class="mt-3 font-normal text-base text-gray-500 max-w-md">
                            If you are a business and wish to sell your freight spaces on Emberfuse, you will have to request for an invite and cannot create an account directly.
                        </p>
                    </div>
                </div>

                <div class="mt-6">
                    <form @submit.prevent="register" class="w-full lg:grid lg:grid-cols-12 gap-6">
                        <div class="mt-6 lg:mt-0 lg:col-span-8">
                            <app-input type="text" v-model="form.name" :error="form.errors.name" label="Full name" placeholder="Johnathan Doeford" required autofocus></app-input>
                        </div>

                        <div class="mt-6 lg:mt-0 lg:col-span-6">
                            <app-input type="tel" v-model="form.phone" :error="form.errors.phone" label="Phone number" placeholder="0765895534" required></app-input>
                        </div>

                        <div class="mt-6 lg:mt-0 lg:col-span-6">
                            <app-input type="email" v-model="form.email" :error="form.errors.email" label="Email address" placeholder="john.doe@example.com" required></app-input>
                        </div>

                        <div class="mt-6 lg:mt-0 lg:col-span-6">
                            <app-input type="password" v-model="form.password" :error="form.errors.password" label="Password" placeholder="cattleFarmer1576@!" required></app-input>
                        </div>

                        <div class="mt-6 lg:mt-0 lg:col-span-6">
                            <app-input type="password" v-model="form.password_confirmation" :error="form.errors.password_confirmation" label="Confirm password" placeholder="cattleFarmer1576@!" required></app-input>
                        </div>

                        <div class="mt-6 lg:mt-0 col-span-12">
                            <p class="font-normal text-xs text-gray-400 max-w-sm">
                                By clicking "Create account", you agree to Emberfuse's <app-link href="#">Terms of Use</app-link> and acknowledge you have read the <app-link href="#">Privacy Policy</app-link>.
                            </p>
                        </div>

                        <div class="mt-6 lg:mt-0 col-span-12 flex items-center justify-start">
                            <app-button type="submit" mode="primary" :class="{ 'opacity-25': form.processing }" :loading="form.processing">
                                Create account <span class="ml-1">&rarr;</span>
                            </app-button>
                        </div>

                        <div class="mt-6 lg:mt-0 col-span-full">
                            <p>
                                Already have an account? <app-link :href="route('login')">Sign in</app-link>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </template>
    </auth-layout>
</template>

<script>
import AuthLayout from '@/Views/Layouts/AuthLayout';
import AppLink from '@/Views/Components/Base/Link';
import AppInput from '@/Views/Components/Inputs/Input';
import AppButton from '@/Views/Components/Buttons/Button';
import Checkbox from '@/Views/Components/Inputs/Checkbox';
import Logo from '@/Views/Components/Logos/Logo';
import Advertisement from './Advertisement.vue';

export default {
    props: ['type'],

    components: {
        AuthLayout,
        AppLink,
        AppInput,
        AppButton,
        Checkbox,
        Logo,
        Advertisement
    },

    data() {
        return {
            form: this.$inertia.form({
                name: null,
                email: null,
                phone: null,
                password: null,
                password_confirmation: null,
                remember: true
            }),
        }
    },

    methods: {
        register() {
            this.form.post(this.route('register'), {
                preserveScroll: true,

                onFinish: () => this.form.reset('password', 'password_confirmation'),
            })
        }
    }
};
</script>
