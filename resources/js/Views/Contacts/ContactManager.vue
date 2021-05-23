<template>
    <div class="md:grid md:grid-cols-12 md:gap-6">
        <div class="md:col-span-6 xl:col-span-7 xl:col-start-0 xl:col-end-8">
            <scrollbar data-simplebar-auto-hide="true" class="min-h-screen h-screen">
                <div class="space-y-4">
                    <div class="rounded-xl bg-gray-50 px-4 py-5 px-6" v-for="contact in contacts.data" :key="contact.id">
                        <div>
                            <div>
                                <span class="font-medium text-gray-800">{{ contact.name }}</span>

                                <div class="text-xs">
                                    <app-link :href="'mailto:' + contact.email">{{ contact.email }}</app-link>
                                </div>
                            </div>

                            <div class="mt-4 grid grid-cols-12 gap-3">
                                <div class="col-span-6">
                                    <span class="text-xs text-gray-500">Birthday is on</span>

                                    <div class="text-normal">
                                        <time :datetime="contact.birthday">{{ simple(contact.birthday) }}</time>
                                    </div>

                                    <div class="text-xs text-gray-500">
                                        <time :datetime="contact.birthday">{{ until(contact.birthday) }}</time>
                                    </div>
                                </div>

                                <div class="col-span-6">
                                    <span class="text-xs text-gray-500">Phone</span>

                                    <div class="text-normal">
                                        <span>{{ contact.phone || 'No number provided' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </scrollbar>

            <div class="mt-6">
                <pagination :links="contacts.links"></pagination>
            </div>
        </div>

        <div class="md:col-span-6 xl:col-span-4 xl:col-start-9 xl:col-end-13">
            <div>
                <h3 class="text-lg font-semibold text-gray-900">
                    Create New Contact
                </h3>

                <p class="mt-1 text-sm text-gray-600">
                    Contact details will be saved to the database and will be used by your external applications.
                </p>
            </div>

            <div class="mt-6">
                <form @submit.prevent="createContact">
                    <div>
                        <app-input type="text" v-model="createContactForm.name" :error="createContactForm.errors.name" label="Full name" placeholder="Johnathan Doeford"></app-input>
                    </div>

                    <div class="mt-6">
                        <app-input type="email" v-model="createContactForm.email" :error="createContactForm.errors.email" label="Email address" placeholder="j.doe@email.com"></app-input>
                    </div>

                    <div class="mt-6">
                        <app-input type="tel" v-model="createContactForm.phone" :error="createContactForm.errors.phone" label="Phone number" placeholder="0765895534"></app-input>
                    </div>

                    <div class="mt-6">
                        <app-input type="date" v-model="createContactForm.birthday" :error="createContactForm.errors.birthday" label="Birthday"></app-input>
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <action-message :on="createContactForm.recentlySuccessful" class="mr-4">
                            Created. <span class="ml-1">&check;</span>
                        </action-message>

                        <app-button type="submit" mode="primary" :class="{ 'opacity-25': createContactForm.processing }" :loading="createContactForm.processing">
                            Create <span class="ml-1">&rarr;</span>
                        </app-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import 'simplebar/dist/simplebar.min.css';
import AppInput from '@/Views/Components/Inputs/Input';
import AppButton from '@/Views/Components/Buttons/Button';
import DialogModal from '@/Views/Components/Modals/DialogModal';
import ActionMessage from '@/Views/Components/Alerts/ActionMessage';
import AppLink from '@/Views/Components/Base/Link';
import Scrollbar from '@/Views/Components/Base/Scrollbar';
import Pagination from '@/Views/Components/Pagination/Pagination';

export default {
    components: {
        AppInput,
        AppButton,
        AppLink,
        ActionMessage,
        DialogModal,
        Scrollbar,
        Pagination
    },

    props: ['contacts'],

    data() {
        return {
            createContactForm: this.$inertia.form({
                name: null,
                email: null,
                phone: null,
                birthday: null,
            }),
        }
    },

    methods: {
        createContact() {
            this.createContactForm.post(this.route('contacts.store'), {
                preserveScroll: true,
                onSuccess: () => this.createApiTokenForm.reset()
            })
        }
    }
}
</script>
