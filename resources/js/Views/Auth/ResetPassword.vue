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

                    <h4 class="mt-6 font-semibold text-xl text-gray-800">Reset password</h4>

                    <p class="mt-3 font-normal text-base text-gray-500">
                        Create a new password for your account using the form below.
                    </p>
                </div>

                <div class="mt-6">
                    <form @submit.prevent="updatePassword" class="w-full">
                        <div class="mt-6 block">
                            <app-input type="email" v-model="form.email" autofocus :error="form.errors.email" label="Email address" placeholder="john.doe@example.com" required></app-input>
                        </div>

                        <div class="mt-6 block">
                            <app-input type="password" v-model="form.password" :error="form.errors.password" label="Password" placeholder="cattleFarmer1576@!" required autocomplete="new-password"></app-input>
                        </div>

                        <div class="mt-6 block">
                            <app-input type="password" v-model="form.password_confirmation" label="Confirm password" placeholder="cattleFarmer1576@!" required autocomplete="new-password"></app-input>
                        </div>

                        <div class="mt-6 block">
                            <app-button type="submit" mode="primary" :class="{ 'opacity-25': form.processing }" :loading="form.processing">
                                Reset password <span class="ml-1">&rarr;</span>
                            </app-button>
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
import AppLink from '@/Views/Components/Base/Link';
import AppInput from '@/Views/Components/Inputs/Input';
import AppButton from '@/Views/Components/Buttons/Button';
import Checkbox from '@/Views/Components/Inputs/Checkbox';
import Advertisement from './Advertisement.vue';

export default {
    props: {
        email: String,
        token: String,
    },

    components: {
        AuthLayout,
        Logo,
        AppLink,
        AppInput,
        AppButton,
        Checkbox,
        Advertisement
    },

    data() {
        return {
            form: this.$inertia.form({
                token: this.token,
                email: this.email,
                password: null,
                password_confirmation: null,
            }),
        }
    },

    methods: {
        updatePassword() {
            this.form.post(this.route('password.update'), {
                preserveScroll: true,
                onFinish: () => this.form.reset('password', 'password_confirmation'),
            });
        }
    }
};
</script>
