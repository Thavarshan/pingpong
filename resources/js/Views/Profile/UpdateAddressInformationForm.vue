<template>
    <action-section>
        <template #title>
            Address Information
        </template>

        <template #description>
            Update your address and location information to match your business.
        </template>

        <template #content>
            <form @submit.prevent="updateAddressInformation">
                <div class="lg:grid lg:grid-cols-12 gap-6">
                    <div class="lg:mt-0 md:col-span-8">
                        <app-input type="text" v-model="form.line1" :error="form.errors.line1" label="Street" placeholder="2975 Driftwood Road"></app-input>
                    </div>

                    <div class="mt-6 lg:mt-0 md:col-span-6">
                        <app-input type="text" v-model="form.city" :error="form.errors.city" label="City" placeholder="San Jose"></app-input>
                    </div>

                    <div class="mt-6 lg:mt-0 md:col-span-6">
                        <app-input type="text" v-model="form.state" :error="form.errors.state" label="State/Province" placeholder="California"></app-input>
                    </div>

                    <div class="mt-6 lg:mt-0 md:col-span-6">
                        <app-input type="text" v-model="form.postal_code" :error="form.errors.postal_code" label="Postcode" placeholder="95127"></app-input>
                    </div>

                    <div class="mt-6 lg:mt-0 md:col-span-6">
                        <app-input type="text" v-model="form.country" :error="form.errors.country" label="Country" placeholder="United States"></app-input>
                    </div>
                </div>

                <div class="flex items-center justify-end mt-6">
                    <action-message :on="form.recentlySuccessful" class="mr-4">
                        Changes saved. <span class="ml-1">&check;</span>
                    </action-message>

                    <app-button type="submit" mode="primary" :class="{ 'opacity-25': form.processing }" :loading="form.processing">
                        Save changes <span class="ml-1">&rarr;</span>
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
    props: ['address'],

    components: {
        ActionSection,
        AppInput,
        AppInputError,
        AppButton,
        ActionMessage
    },

    data() {
        return {
            form: this.$inertia.form({
                _method: 'PUT',
                line1: this.address.line1,
                city: this.address.city,
                state: this.address.state,
                country: this.address.country,
                postal_code: this.address.postal_code,
            }),
        }
    },

    methods: {
        updateAddressInformation() {
            this.form.post(this.route('user-address.update'), {
                errorBag: 'updateAddressInformation',
                preserveScroll: true,
            });
        },
    }
}
</script>
