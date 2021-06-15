<template>
    <app-layout>
        <div>
            <contact-information-form state="create"></contact-information-form>

            <section-border></section-border>

            <address-information-form :address="[]"></address-information-form>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Views/Layouts/AppLayout';
import SectionBorder from '@/Views/Components/Sections/SectionBorder';
import ContactInformationForm from './ContactInformationForm';
import AddressInformationForm from './AddressInformationForm';

export default {
    components: {
        AppLayout,
        SectionBorder,
        ContactInformationForm,
        AddressInformationForm,
    },
}
</script>
