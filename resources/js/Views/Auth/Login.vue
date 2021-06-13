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

                    <h4 class="mt-6 font-semibold text-xl text-gray-800">Login to your account</h4>

                    <p class="mt-3 font-normal text-base text-gray-500">
                        Thank you for getting back to us. Let's access your account and get you started.
                    </p>
                </div>

                <div class="mt-6">
                    <form @submit.prevent="login" class="w-full">
                        <div class="block">
                            <app-input type="email" v-model="form.email" :error="form.errors.email" label="Email address" placeholder="john.doe@example.com" required autofocus></app-input>
                        </div>

                        <div class="mt-6 block">
                            <app-input type="password" v-model="form.password" :error="form.errors.password" label="Password" placeholder="cattleFarmer1576@!" required></app-input>
                        </div>

                        <div class="mt-6 flex items-center justify-between">
                            <div>
                                <checkbox id="remember" v-model:checked="form.remember" label="Stay signed in"></checkbox>
                            </div>

                            <div class="text-sm leading-5">
                                <app-link :href="route('password.request')">Forgot your password?</app-link>
                            </div>
                        </div>

                        <div class="mt-6 block">
                            <app-button type="submit" mode="primary" :class="{ 'opacity-25': form.processing }" :loading="form.processing">
                                Sign in <span class="ml-1">&rarr;</span>
                            </app-button>
                        </div>

                        <div class="mt-6">
                            <p>
                                Don't have an account yet? <app-link :href="route('register')">Create account</app-link>.
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
                email: null,
                password: null,
                remember: true
            }),
        }
    },

    methods: {
        login() {
            this.form
                .transform(data => ({
                    ... data,
                    remember: this.form.remember ? 'on' : ''
                }))
                .post(this.route('login'), {
                    onFinish: () => this.form.reset('password'),
                })
        }
    }
};
</script>
