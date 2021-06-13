<template>
    <div class="min-h-screen min-w-full overflow-x-hidden">
        <banner></banner>

        <!-- Main Header Area -->
        <header>
            <navbar class="bg-gray-800">
                <template #logo>
                    <logo classes="h-8 w-8" :title="config('app.name')"></logo>
                </template>

                <template #linksleft>
                    <navbar-link :href="route('home')" :active="route().current('home')" class="text-white bg-gray-900 hover:bg-gray-900 focus:bg-gray-900">
                        Home
                    </navbar-link>
                </template>

                <template #linksright>
                    <dropdown align="right" class="block md:hidden">
                        <template #trigger>
                            <button class="flex text-sm text-gray-500 focus:text-gray-400 active:text-gray-300 border-2 border-transparent rounded-xl focus:outline-none focus:border-transparent transition duration-150 ease-in-out">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                                </svg>
                            </button>
                        </template>

                        <template #items>
                            <dropdown-link :href="route('home')" :active="route().current('home')">Home</dropdown-link>
                        </template>
                    </dropdown>

                    <dropdown align="right">
                        <template #trigger>
                            <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300  transition duration-150 ease-in-out">
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
import axios from 'axios';
import Logo from '@/Views/Components/Logos/Logo';
import Navbar from '@/Views/Components/Navbars/Navbar';
import NavbarLink from '@/Views/Components/Navbars/NavbarLink';
import Dropdown from '@/Views/Components/Dropdowns/Dropdown';
import DropdownLink from '@/Views/Components/Dropdowns/DropdownLink';
import Banner from '@/Views/Components/Banners/Banner';

export default {
    components: {
        Logo,
        Navbar,
        NavbarLink,
        Dropdown,
        DropdownLink,
        Banner,
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
