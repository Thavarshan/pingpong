<template>
    <div>
        <action-section>
            <template #title>
                Create API Token
            </template>

            <template #description>
                API tokens allow third-party services to authenticate with our application on your behalf.
            </template>

            <template #content>
                <form @submit.prevent="createApiToken">
                    <div class="lg:grid lg:grid-cols-12 gap-6">
                        <div class="md:col-span-8">
                            <app-input type="text" v-model="createApiTokenForm.name" :error="createApiTokenForm.errors.name" label="Full name" placeholder="Johnathan Doeford"></app-input>
                        </div>

                        <div class="mt-6 lg:mt-0 col-span-6" v-if="availablePermissions.length > 0">
                            <h6 class="text-gray-600 text-sm font-semibold">Permissions</h6>

                            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div v-for="permission in availablePermissions" :key="permission">
                                    <checkbox :label="permission" :value="permission" :id="permission" v-model:checked="createApiTokenForm.permissions"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <action-message :on="createApiTokenForm.recentlySuccessful" class="mr-4">
                            Created. <span class="ml-1">&check;</span>
                        </action-message>

                        <app-button type="submit" mode="primary" :class="{ 'opacity-25': createApiTokenForm.processing }" :loading="createApiTokenForm.processing">
                            Create <span class="ml-1">&rarr;</span>
                        </app-button>
                    </div>
                </form>
            </template>
        </action-section>

        <div v-if="tokens.length > 0">
            <section-border></section-border>

            <!-- Manage API Tokens -->
            <div class="mt-10 sm:mt-0">
                <action-section>
                    <template #title>
                        Manage API Tokens
                    </template>

                    <template #description>
                        You may delete any of your existing tokens if they are no longer needed.
                    </template>

                    <template #content>
                        <div class="space-y-4">
                            <div class="rounded-lg bg-blue-50 px-4 py-5 px-6" v-for="token in tokens" :key="token.id">
                                <div class="flex items-center justify-between">
                                    <div class="leading-none">
                                        <div>
                                            <span class="text-sm font-medium">{{ token.name }}</span>
                                        </div>

                                        <div v-if="token.last_used_ago">
                                            <span class="text-xs text-gray-400">
                                                Last used {{ token.last_used_ago }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="flex items-center">
                                        <button class="cursor-pointer ml-6 text-sm text-blue-500" @click="manageApiTokenPermissions(token)" v-if="availablePermissions.length > 0">
                                            Permissions
                                        </button>

                                        <button class="cursor-pointer ml-6 text-sm text-red-500" @click="confirmApiTokenDeletion(token)">
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </action-section>
            </div>
        </div>

        <!-- Token Value Modal -->
        <dialog-modal :show="displayingToken" :hasActions="true" @close="displayingToken = false">
            <template #title>
                API Token
            </template>

            <template #content>
                <p class="text-sm text-gray-600">
                    Please copy your new API token. For your security, it won't be shown again.
                </p>

                <div class="mt-4 bg-gray-100 px-4 py-2 rounded-lg" v-if="$page.props.preflight.flash.token">
                    <span class="font-mono font-medium text-sm text-gray-500">
                        {{ $page.props.preflight.flash.token }}
                    </span>
                </div>
            </template>

            <template #actions>
                <app-button @clicked="displayingToken = false" mode="secondary">
                    Close
                </app-button>
            </template>
        </dialog-modal>

        <!-- API Token Permissions Modal -->
        <dialog-modal :show="managingPermissionsFor" :hasActions="true" @close="managingPermissionsFor = null">
            <template #title>
                API Token Permissions
            </template>

            <template #content>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div v-for="permission in availablePermissions" :key="permission">
                        <checkbox :label="permission" :value="permission" :id="permission + 'Update'" v-model:checked="updateApiTokenForm.permissions"/>
                    </div>
                </div>
            </template>

            <template #actions>
                <app-button @clicked="managingPermissionsFor = null" mode="secondary">
                    Cancel
                </app-button>

                <app-button class="ml-3" @clicked="updateApiToken" :class="{ 'opacity-25': updateApiTokenForm.processing }" :loading="updateApiTokenForm.processing" mode="primary">
                    Save changes
                </app-button>
            </template>
        </dialog-modal>

        <dialog-modal :show="apiTokenBeingDeleted" :hasActions="true" @close="apiTokenBeingDeleted = null">
            <template #title>
                Delete API Token
            </template>

            <template #content>
                <p class="text-sm text-gray-600">
                    Are you sure you would like to delete this API token?
                </p>
            </template>

            <template #actions>
                <app-button mode="secondary" @clicked="apiTokenBeingDeleted = null">
                    Cancel
                </app-button>

                <app-button mode="danger" class="ml-2" @clicked="deleteApiToken" :class="{ 'opacity-25': deleteApiTokenForm.processing }" :disabled="deleteApiTokenForm.processing">
                    Delete
                </app-button>
            </template>
        </dialog-modal>
    </div>
</template>

<script>
import AppInput from '@/Views/Components/Inputs/Input';
import AppButton from '@/Views/Components/Buttons/Button';
import Checkbox from '@/Views/Components/Inputs/Checkbox';
import DialogModal from '@/Views/Components/Modals/DialogModal';
import ActionMessage from '@/Views/Components/Alerts/ActionMessage';
import ActionSection from '@/Views/Components/Sections/ActionSection';
import SectionBorder from '@/Views/Components/Sections/SectionBorder';

export default {
    components: {
        ActionSection,
        AppInput,
        AppButton,
        ActionMessage,
        Checkbox,
        SectionBorder,
        DialogModal
    },

    props: [
        'tokens',
        'availablePermissions',
        'defaultPermissions',
    ],

    data() {
        return {
            createApiTokenForm: this.$inertia.form({
                name: '',
                permissions: this.defaultPermissions,
            }),

            updateApiTokenForm: this.$inertia.form({
                permissions: []
            }),

            deleteApiTokenForm: this.$inertia.form(),

            displayingToken: false,
            managingPermissionsFor: null,
            apiTokenBeingDeleted: null,
        }
    },

    methods: {
        createApiToken() {
            this.createApiTokenForm.post(this.route('api-tokens.store'), {
                preserveScroll: true,
                onSuccess: () => {
                    this.displayingToken = true
                    this.createApiTokenForm.reset()
                }
            })
        },

        manageApiTokenPermissions(token) {
            this.updateApiTokenForm.permissions = token.abilities

            this.managingPermissionsFor = token
        },

        updateApiToken() {
            this.updateApiTokenForm.put(this.route('api-tokens.update', this.managingPermissionsFor), {
                preserveScroll: true,
                preserveState: true,
                onSuccess: () => (this.managingPermissionsFor = null),
            })
        },

        confirmApiTokenDeletion(token) {
            this.apiTokenBeingDeleted = token
        },

        deleteApiToken() {
            this.deleteApiTokenForm.delete(this.route('api-tokens.destroy', this.apiTokenBeingDeleted), {
                preserveScroll: true,
                preserveState: true,
                onSuccess: () => (this.apiTokenBeingDeleted = null),
            })
        },
    },
}
</script>
