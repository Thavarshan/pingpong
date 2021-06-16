<template>
    <div class="min-h-screen min-w-full overflow-x-hidden">
        <banner></banner>

        <!-- Main Header Area -->
        <header>
            <navbar class="bg-indigo-800">
                <template #logo>
                    <logo classes="h-8 w-auto text-indigo-300" :title="config('app.name')"></logo>
                </template>

                <template #linksleft>
                    <!-- N/A -->
                </template>

                <template #linksright>
                    <app-button :link="true" mode="secondary" :href="route('contacts.create')" :active="route().current('contacts.create')" class="text-indigo-800 hover:text-indigo-900 focus:text-indigo-900 active:text-indigo-900">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>

                        <span class="ml-1">
                            New contact
                        </span>
                    </app-button>

                    <dropdown align="right">
                        <template #trigger>
                            <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-indigo-300 transition duration-150 ease-in-out">
                                <img :src="$page.props.user.profile_photo_url" class="rounded-full object-cover w-8 h-8" :alt="$page.props.user.name"/>
                            </button>
                        </template>

                        <template #items>
                            <dropdown-link :href="route('user.show')" :active="route().current('user.show')">Profile</dropdown-link>
                            <dropdown-link :href="route('api-tokens.index')" :active="route().current('api-tokens.index')">API token</dropdown-link>
                            <dropdown-link href="#" @clicked="logout">Sign out</dropdown-link>
                        </template>
                    </dropdown>
                </template>
            </navbar>
        </header>

        <!-- Main Content Area -->
        <main class="py-8" role="main">
            <div class="container mx-auto px-4 sm:px-6">
                <slot></slot>
            </div>
        </main>

        <!-- Main Footer Area -->
        <footer>
            <div class="container mx-auto px-4 sm:px-6">
                <div class="py-16 flex items-center justify-center">
                    <p class="text-center">
                        <span class="text-gray-500 text-xs">{{ copyright }}</span>
                    </p>
                </div>
            </div>
        </footer>
    </div>
</template>

<script>
import Logo from '@/Views/Components/Logos/Logo';
import Navbar from '@/Views/Components/Navbars/Navbar';
import NavbarLink from '@/Views/Components/Navbars/NavbarLink';
import Dropdown from '@/Views/Components/Dropdowns/Dropdown';
import DropdownLink from '@/Views/Components/Dropdowns/DropdownLink';
import Banner from '@/Views/Components/Banners/Banner';
import AppButton from '@/Views/Components/Buttons/Button';

export default {
    components: {
        Logo,
        Navbar,
        NavbarLink,
        Dropdown,
        DropdownLink,
        Banner,
        AppButton,
    },

    data() {
        return {
            copyright: `© ${new Date().getFullYear()} ${this.config('app.name')}. All rights reserved.`,
        };
    },

    methods: {
        logout() {
            this.$inertia.post(this.route('logout'));
        }
    }
}
</script>
