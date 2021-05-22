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

                    <h4 class="mt-6 font-semibold text-xl text-gray-800">Confirm you login attempt</h4>

                    <div class="mt-3 font-normal text-base text-gray-500">
                        <p v-if="! recovery">
                            Please confirm access to your account by entering the authentication code provided by your authenticator application.
                        </p>

                        <p v-else>
                            Please confirm access to your account by entering one of your emergency recovery codes provided to you when enabling Two Factor Authentication.
                        </p>
                    </div>
                </div>

                <div class="mt-6">
                    <form @submit.prevent="login" class="w-full">
                        <div v-if="! recovery" class="block">
                            <app-input type="text" v-model="form.code" ref="code" id="code" inputmode="numeric" :error="form.errors.code" label="Code" required autofocus autocomplete="one-time-code"></app-input>
                        </div>

                        <div v-else class="block">
                            <app-input type="text" v-model="form.recovery_code" inputmode="numeric" :error="form.errors.recovery_code" label="Recovery code" ref="recovery_code" id="recovery_code" required autocomplete="one-time-code"></app-input>
                        </div>

                        <div class="mt-6 flex items-center justify-between">
                            <app-button type="button" @clicked="toggleRecovery" mode="secondary">
                                <template v-if="! recovery">
                                    Use a recovery code
                                </template>

                                <template v-else>
                                    Use authentication code
                                </template>
                            </app-button>

                            <app-button class="ml-4" type="submit" mode="primary" :class="{ 'opacity-25': form.processing }" :loading="form.processing">
                                Confirm it's me <span class="ml-1">&rarr;</span>
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
            recovery: false,

            form: this.$inertia.form({
                code: null,
                recovery_code: null,
            })
        }
    },

    methods: {
        toggleRecovery() {
            this.recovery ^= true;

            this.$nextTick(() => {
                if (this.recovery) {
                    this.$refs.recovery_code.focus();
                    this.form.code = '';
                } else {
                    this.$refs.code.focus();
                    this.form.recovery_code = null;
                }
            })
        },

        login() {
            this.form.post(this.route('two-factor.login'));
        }
    }
}
</script>
