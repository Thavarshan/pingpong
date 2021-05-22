<template>
    <action-section>
        <template #title>
            Delete Account
        </template>

        <template #description>
            Permanently delete your account.
        </template>

        <template #content>
            <div class="max-w-xl">
                <p class="text-sm text-gray-600">
                    Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.
                </p>
            </div>

            <div class="mt-5">
                <app-button mode="danger" @clicked="confirmUserDeletion">
                    Delete account
                </app-button>
            </div>

            <dialog-modal :show="confirmingUserDeletion" :hasActions="true" @close="closeModal">
                <template #title>
                    Delete Account
                </template>

                <template #content>
                    <p class="text-sm text-gray-600">
                        Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.
                    </p>

                    <div class="mt-4">
                        <app-input type="password" v-model="form.password" :error="form.errors.password" ref="password" label="Password" placeholder="cattleFarmer1576@!" @keyup.enter="deleteUser"></app-input>
                    </div>
                </template>

                <template #actions>
                    <app-button mode="secondary" @clicked="closeModal">
                        Cancel
                    </app-button>

                    <app-button mode="danger" class="ml-2" @clicked="deleteUser" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Delete account
                    </app-button>
                </template>
            </dialog-modal>
        </template>
    </action-section>
</template>

<script>
import ActionSection from '@/Views/Components/Sections/ActionSection';
import AppButton from '@/Views/Components/Buttons/Button';
import AppInput from '@/Views/Components/Inputs/Input';
import DialogModal from '@/Views/Components/Modals/DialogModal';

export default {
    components: {
        ActionSection,
        AppButton,
        AppInput,
        DialogModal,
    },

    data() {
        return {
            confirmingUserDeletion: false,

            form: this.$inertia.form({
                password: null,
            })
        }
    },

    methods: {
        confirmUserDeletion() {
            this.confirmingUserDeletion = true;

            setTimeout(() => this.$refs.password.focus(), 250);
        },

        deleteUser() {
            this.form.delete(this.route('user.destroy'), {
                preserveScroll: true,
                onSuccess: () => this.closeModal(),
                onError: () => this.$refs.password.focus(),
                onFinish: () => this.form.reset(),
            });
        },

        closeModal() {
            this.confirmingUserDeletion = false;

            this.form.reset();
        },
    },
}
</script>
