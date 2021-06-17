<template>
    <app-layout>
        <div>
            <contact-information-form state="update" :contact="contact"></contact-information-form>

            <section-border></section-border>

            <address-information-form :contact="contact"></address-information-form>

            <section-border></section-border>

            <delete-contact-form :contact="contact"></delete-contact-form>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Views/Layouts/AppLayout';
import SectionBorder from '@/Views/Components/Sections/SectionBorder';
import ContactInformationForm from './ContactInformationForm';
import AddressInformationForm from './AddressInformationForm';
import DeleteContactForm from './DeleteContactForm';

export default {
    components: {
        AppLayout,
        SectionBorder,
        ContactInformationForm,
        AddressInformationForm,
        DeleteContactForm
    },

    props: ['contact']
}
</script>
