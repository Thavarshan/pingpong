<template>
    <app-layout>
        <api-token-manager :tokens="tokens" :available-permissions="availablePermissions" :default-permissions="defaultPermissions" />
    </app-layout>
</template>

<script>
import ApiTokenManager from './ApiTokenManager';
import AppLayout from '@/Views/Layouts/AppLayout';

export default {
    props: [
        'tokens',
        'availablePermissions',
        'defaultPermissions',
    ],

    components: {
        ApiTokenManager,
        AppLayout,
    },
}
</script>
