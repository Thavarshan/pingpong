<template>
    <action-section>
        <template #title>
            Two Factor Authentication
        </template>

        <template #description>
            Add additional security to your account using two factor authentication.
        </template>

        <template #content>
            <h6 class="text-base font-semibold text-gray-900" v-if="twoFactorEnabled">
                You have enabled two factor authentication.
            </h6>

            <h6 class="text-base font-semibold text-gray-900" v-else>
                You have not enabled two factor authentication.
            </h6>

            <div class="mt-3 max-w-xl">
                <p class="text-sm text-gray-600">
                    When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone's Google Authenticator application.
                </p>
            </div>

            <div v-if="twoFactorEnabled">
                <div v-if="qrCode">
                    <div class="mt-4 max-w-xl">
                        <p class="font-semibold text-sm text-gray-600">
                            Two factor authentication is now enabled. Scan the following QR code using your phone's authenticator application.
                        </p>
                    </div>

                    <div class="mt-4 dark:p-4 dark:w-56 dark:bg-white" v-html="qrCode">
                    </div>
                </div>

                <div v-if="recoveryCodes.length > 0">
                    <div class="mt-4 max-w-xl">
                        <p class="font-semibold text-sm text-gray-600">
                            Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost.
                        </p>
                    </div>

                    <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 rounded-lg">
                        <div v-for="code in recoveryCodes" :key="code">
                            {{ code }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <div v-if="! twoFactorEnabled">
                    <confirm-password-modal @confirmed="enableTwoFactorAuthentication">
                        <app-button type="button" mode="primary" :class="{ 'opacity-25': enabling }" :loading="enabling">
                            Enable
                        </app-button>
                    </confirm-password-modal>
                </div>

                <div v-else>
                    <confirm-password-modal @confirmed="regenerateRecoveryCodes">
                        <app-button mode="secondary" class="mr-3" v-if="recoveryCodes.length > 0">
                            Regenerate recovery codes
                        </app-button>
                    </confirm-password-modal>

                    <confirm-password-modal @confirmed="showRecoveryCodes">
                        <app-button mode="secondary" class="mr-3" v-if="recoveryCodes.length === 0">
                            Show Recovery Codes
                        </app-button>
                    </confirm-password-modal>

                    <confirm-password-modal @confirmed="disableTwoFactorAuthentication">
                        <app-button mode="danger" :class="{ 'opacity-25': disabling }" :loading="disabling">
                            Disable
                        </app-button>
                    </confirm-password-modal>
                </div>
            </div>
        </template>
    </action-section>
</template>

<script>
import axios from 'axios';
import ConfirmPasswordModal from '@/Views/Components/Modals/ConfirmPasswordModal';
import ActionSection from '@/Views/Components/Sections/ActionSection';
import AppButton from '@/Views/Components/Buttons/Button';

export default {
    components: {
        ActionSection,
        AppButton,
        ConfirmPasswordModal
    },

    computed: {
        twoFactorEnabled() {
            return ! this.enabling && this.$page.props.user.two_factor_enabled;
        }
    },

    data() {
        return {
            enabling: false,
            disabling: false,

            qrCode: null,
            recoveryCodes: [],
        }
    },

    methods: {
        enableTwoFactorAuthentication() {
            this.enabling = true;

            this.$inertia.post('/user/two-factor-authentication', {}, {
                preserveScroll: true,
                onSuccess: () => Promise.all([
                    this.showQrCode(),
                    this.showRecoveryCodes(),
                ]),
                onFinish: () => (this.enabling = false),
            });
        },

        showQrCode() {
            return axios.get('/user/two-factor-qr-code')
                .then(response => this.qrCode = response.data.svg);
        },

        showRecoveryCodes() {
            return axios.get('/user/two-factor-recovery-codes')
                .then(response => this.recoveryCodes = response.data);
        },

        regenerateRecoveryCodes() {
            axios.post('/user/two-factor-recovery-codes')
                .then(response => this.showRecoveryCodes());
        },

        disableTwoFactorAuthentication() {
            this.disabling = true;

            this.$inertia.delete('/user/two-factor-authentication', {
                preserveScroll: true,
                onSuccess: () => (this.disabling = false),
            });
        },
    },

    computed: {
        twoFactorEnabled() {
            return ! this.enabling && this.$page.props.user.two_factor_enabled;
        }
    }
}
</script>
