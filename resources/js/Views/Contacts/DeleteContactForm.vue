<template>
    <action-section>
        <template #title>
            Delete Contact
        </template>

        <template #description>
            Permanently delete the contact.
        </template>

        <template #content>
            <div class="max-w-xl">
                <p class="text-sm text-gray-600">
                    Are you sure you want to delete this contact? Once the contact has been deleted, all of its resources and data will be permanently deleted.
                </p>
            </div>

            <div class="mt-5">
                <app-button mode="danger" @clicked="deleteUser" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Delete contact
                </app-button>
            </div>
        </template>
    </action-section>
</template>

<script>
import ActionSection from '@/Views/Components/Sections/ActionSection';
import AppButton from '@/Views/Components/Buttons/Button';

export default {
    components: {
        ActionSection,
        AppButton,
    },

    props: ['contact'],

    data() {
        return {
            form: this.$inertia.form()
        }
    },

    methods: {
        deleteUser() {
            this.form.delete(this.route('contacts.destroy', { contact: this.contact }));
        }
    },
}
</script>
