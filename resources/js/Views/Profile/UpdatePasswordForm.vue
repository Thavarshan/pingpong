<template>
    <action-section>
        <template #title>
            Update Password
        </template>

        <template #description>
            Ensure your account is using a long, random password to stay secure.
        </template>

        <template #content>
            <form @submit.prevent="updatePassword">
                <div class="lg:grid lg:grid-cols-12 gap-6">
                    <div class="col-span-10">
                        <p class="font-medium text-sm text-gray-500">
                            Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
                        </p>
                    </div>

                    <div class="mt-6 lg:mt-0 md:col-span-8">
                        <app-input type="password" v-model="form.current_password" ref="current_password" :error="form.errors.current_password" label="Current password" placeholder="cattleFarmer1576@!" autocomplete="current-password"></app-input>

                        <div class="mt-2">
                            <p class="font-medium text-xs text-gray-500 leading-normal">
                                Type in your current password to confirm it's really you making the change.
                            </p>
                        </div>
                    </div>

                    <div class="mt-6 lg:mt-0 md:col-span-8">
                        <app-input type="password" v-model="form.password" :error="form.errors.password" ref="password" label="New password" placeholder="hunterKiller739@3$"></app-input>
                    </div>

                    <div class="mt-6 lg:mt-0 md:col-span-8">
                        <app-input type="password" v-model="form.password_confirmation" :error="form.errors.password_confirmation" label="Retype new password" placeholder="hunterKiller739@3$"></app-input>
                    </div>
                </div>

                <div class="flex items-center justify-end mt-6">
                    <action-message :on="form.recentlySuccessful" class="mr-4">
                        Changes saved. <span class="ml-1">&check;</span>
                    </action-message>

                    <app-button type="submit" mode="primary" :class="{ 'opacity-25': form.processing }" :loading="form.processing">
                        Update password <span class="ml-1">&rarr;</span>
                    </app-button>
                </div>
            </form>
        </template>
    </action-section>
</template>

<script>
import ActionSection from '@/Views/Components/Sections/ActionSection';
import AppInput from '@/Views/Components/Inputs/Input';
import AppInputError from '@/Views/Components/Inputs/InputError';
import AppButton from '@/Views/Components/Buttons/Button';
import ActionMessage from '@/Views/Components/Alerts/ActionMessage';

export default {
    components: {
        ActionSection,
        AppInput,
        AppInputError,
        AppButton,
        ActionMessage,
    },

    data() {
        return {
            form: this.$inertia.form({
                current_password: null,
                password: null,
                password_confirmation: null,
            })
        }
    },

    methods: {
        updatePassword() {
            this.form.put(this.route('user-password.update'), {
                errorBag: 'updatePassword',
                preserveScroll: true,

                onSuccess: () => this.form.reset(),

                onError: () => {
                    if (this.form.errors.password) {
                        this.form.reset('password', 'password_confirmation');

                        this.$refs.password.focus();
                    }

                    if (this.form.errors.current_password) {
                        this.form.reset('current_password');

                        this.$refs.current_password.focus();
                    }
                }
            });
        }
    }
}
</script>
