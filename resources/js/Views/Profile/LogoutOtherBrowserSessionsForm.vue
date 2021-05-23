<template>
    <action-section>
        <template #title>
            Browser Sessions
        </template>

        <template #description>
            Manage and logout your active sessions on other browsers and devices.
        </template>

        <template #content>
            <div class="max-w-xl">
                <p class="text-sm text-gray-600">
                    If necessary, you may logout of all of your other browser sessions across all of your devices. Some of your recent sessions are listed below; however, this list may not be exhaustive. If you feel your account has been compromised, you should also update your password.
                </p>
            </div>

            <div class="mt-6 space-y-6" v-if="sessions.length > 0">
                <div class="flex items-center" v-for="(session, i) in sessions" :key="i">
                    <div>
                        <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="w-8 h-8 text-gray-500" v-if="session.agent.is_desktop">
                            <path d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>

                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8 text-gray-500" v-else>
                            <path d="M0 0h24v24H0z" stroke="none"></path><rect x="7" y="4" width="10" height="16" rx="1"></rect><path d="M11 5h2M12 17v.01"></path>
                        </svg>
                    </div>

                    <div class="ml-3">
                        <div class="text-sm text-gray-600">
                            {{ session.agent.platform }} - {{ session.agent.browser }}
                        </div>

                        <div>
                            <div class="text-xs text-gray-500">
                                {{ session.ip_address }},

                                <span class="text-green-500 font-semibold" v-if="session.is_current_device">This device</span>
                                <span v-else>Last active {{ session.last_active }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex items-center">
                <app-button @clicked="confirmLogout" mode="primary">
                    Logout other browser sessions
                </app-button>

                <action-message :on="form.recentlySuccessful" class="ml-4">
                    Done.
                </action-message>
            </div>

            <dialog-modal :show="confirmingLogout" :hasActions="true" @close="closeModal">
                <template #title>
                    Logout Other Browser Sessions
                </template>

                <template #content>
                    <p class="text-sm text-gray-600">
                        Please enter your password to confirm you would like to logout of your other browser sessions across all of your devices.
                    </p>

                    <div class="mt-4">
                        <app-input type="password" v-model="form.password" :error="form.errors.password" ref="password" label="Password" placeholder="cattleFarmer1576@!" @keyup.enter="logoutOtherBrowserSessions"></app-input>
                    </div>
                </template>

                <template #actions>
                    <app-button @clicked="closeModal" mode="secondary">
                        Cancel
                    </app-button>

                    <app-button class="ml-3" @clicked="logoutOtherBrowserSessions" :class="{ 'opacity-25': form.processing }" :loading="form.processing" mode="primary">
                        Logout other browser sessions
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
import ActionMessage from '@/Views/Components/Alerts/ActionMessage';

export default {
    props: ['sessions'],

    components: {
        ActionSection,
        AppButton,
        AppInput,
        DialogModal,
        ActionMessage
    },

    data() {
        return {
            confirmingLogout: false,

            form: this.$inertia.form({
                password: null,
            })
        }
    },

    methods: {
        confirmLogout() {
            this.confirmingLogout = true;

            setTimeout(() => this.$refs.password.focus(), 250);
        },

        logoutOtherBrowserSessions() {
            this.form.delete(this.route('other-browser-sessions.destroy'), {
                preserveScroll: true,
                onSuccess: () => this.closeModal(),
                onError: () => this.$refs.password.focus(),
                onFinish: () => this.form.reset(),
            });
        },

        closeModal() {
            this.confirmingLogout = false;

            this.form.reset();
        },
    },
}
</script>
