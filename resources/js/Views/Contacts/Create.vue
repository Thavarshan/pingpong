<template>
    <app-layout>
        <div>
            <contact-information-form state="create"></contact-information-form>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Views/Layouts/AppLayout';
import SectionBorder from '@/Views/Components/Sections/SectionBorder';
import ContactInformationForm from './ContactInformationForm';

export default {
    components: {
        AppLayout,
        SectionBorder,
        ContactInformationForm,
    },
}
</script>
