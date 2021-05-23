<template>
    <app-layout>
        <div>
            <update-profile-information-form :user="$page.props.user"></update-profile-information-form>

            <section-border></section-border>

            <update-address-information-form :address="$page.props.user.address || []"></update-address-information-form>

            <section-border></section-border>

            <update-password-form></update-password-form>

            <section-border></section-border>

            <two-factor-authentication-form></two-factor-authentication-form>

            <section-border></section-border>

            <logout-other-browser-sessions-form :sessions="$page.props.user.sessions"></logout-other-browser-sessions-form>

            <section-border></section-border>

            <delete-user-form></delete-user-form>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Views/Layouts/AppLayout';
import SectionBorder from '@/Views/Components/Sections/SectionBorder';
import UpdateProfileInformationForm from './UpdateProfileInformationForm';
import UpdateAddressInformationForm from './UpdateAddressInformationForm';
import UpdatePasswordForm from './UpdatePasswordForm';
import TwoFactorAuthenticationForm from './TwoFactorAuthenticationForm';
import DeleteUserForm from './DeleteUserForm';
import LogoutOtherBrowserSessionsForm from './LogoutOtherBrowserSessionsForm';

export default {
    components: {
        AppLayout,
        SectionBorder,
        UpdateProfileInformationForm,
        UpdateAddressInformationForm,
        UpdatePasswordForm,
        TwoFactorAuthenticationForm,
        DeleteUserForm,
        LogoutOtherBrowserSessionsForm,
    },
}
</script>
