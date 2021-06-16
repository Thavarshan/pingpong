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

                    <h4 class="mt-6 font-semibold text-xl text-gray-800">Forgot your password?</h4>

                    <p class="mt-3 font-normal text-base text-gray-500">
                        If you don't remember your password, you can reset it here.
                    </p>
                </div>

                <div class="mt-6">
                    <form @submit.prevent="requestLink" class="mt-6 w-full">
                        <div class="block">
                            <app-input type="email" v-model="form.email" :error="form.errors.email" label="Email address" placeholder="john.doe@example.com" autofocus required></app-input>
                        </div>

                        <div class="mt-6 flex items-center justify-between">
                            <app-button type="submit" mode="primary" :class="{ 'opacity-25 cursor-not-allowed': form.processing || disabled }" :loading="form.processing">
                                Send password reset link <span class="ml-1">&rarr;</span>
                            </app-button>
                        </div>

                        <div class="mt-6">
                            <action-message :on="form.recentlySuccessful">A password reset has been link sent to your email.</action-message>
                        </div>

                        <div class="mt-6">
                            <p class="text-xs text-gray-500">
                                Please enter the email address assigned to your account below, and then click the "Send password reset link" button. An email will immediately be sent to you with instructions on how to set a new password
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
import Logo from '@/Views/Components/Logos/Logo';
import AppLink from '@/Views/Components/Base/Link';
import AppInput from '@/Views/Components/Inputs/Input';
import AppButton from '@/Views/Components/Buttons/Button';
import Checkbox from '@/Views/Components/Inputs/Checkbox';
import ActionMessage from '../Components/Alerts/ActionMessage';
import Advertisement from './Advertisement.vue';

export default {
    components: {
        AuthLayout,
        Logo,
        AppLink,
        AppInput,
        AppButton,
        Checkbox,
        ActionMessage,
        Advertisement
    },

    data() {
        return {
            disabled: false,

            form: this.$inertia.form({
                email: null,
            }),
        }
    },

    methods: {
        requestLink() {
            this.form.post(this.route('password.email'), {
                preserveScroll: true,

                onSuccess: () => setTimeout(() => this.disabled = true, 2000)
            });
        }
    }
};
</script>
