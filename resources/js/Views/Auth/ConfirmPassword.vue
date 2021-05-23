<template>
    <auth-layout>
        <template #left>
            <advertisement></advertisement>
        </template>

        <template #right>
            <div class="max-w-sm">
                <div>
                    <div class="mb-6 block md:hidden">
                        <logo :title="config('app.name')" classes="h-16 w-16 text-blue-500"></logo>
                    </div>

                    <h4 class="mt-6 font-semibold text-xl text-gray-800">Confirm your password</h4>

                    <p class="mt-3 font-normal text-base text-gray-500">
                        This is a secure area of the application. Please confirm your password before continuing.
                    </p>
                </div>

                <form @submit.prevent="confirm" class="mt-6 w-full">
                    <div class="mt-6 block">
                        <app-input type="password" v-model="form.password" :error="form.errors.password" label="Password" placeholder="cattleFarmer1576@!" required></app-input>
                    </div>

                    <div class="mt-6 block">
                        <app-button type="submit" mode="primary" :class="{ 'opacity-25': form.processing }" :loading="form.processing">
                            Confirm <span class="ml-1">&rarr;</span>
                        </app-button>
                    </div>
                </form>
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

export default {
    components: {
        AuthLayout,
        Logo,
        AppLink,
        AppInput,
        AppButton,
        Checkbox
    },

    data() {
        return {
            form: this.$inertia.form({
                password: null,
            }),
        }
    },

    methods: {
        confirm() {
            this.form.post(this.route('password.confirm'), {
                onFinish: () => this.form.reset(),
            })
        }
    }
};
</script>
