<template>
    <app-layout>
        <contact-manager :contacts="contacts"></contact-manager>
    </app-layout>
</template>

<script>
import AppLayout from '@/Views/Layouts/AppLayout';
import ContactManager from './ContactManager';

export default {
    components: {
        AppLayout,
        ContactManager
    },

    props: [
        'contacts',
    ],
}
</script>
