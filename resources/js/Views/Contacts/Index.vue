<template>
    <app-layout>
        <div class="mb-6 md:flex items-center justify-between">
            <div class="w-full md:w-1/2 xl:w-1/3">
                <app-input class="w-full" type="text" placeholder="Search contact by name..." v-model="searchForm.search" :error="searchForm.errors.search"></app-input>
            </div>

            <div class="mt-4 md:mt-0">
                <dropdown align="right">
                    <template #trigger>
                        <app-button mode="secondary">Filter</app-button>
                    </template>

                    <template #items>
                        <dropdown-link :href="route('contacts.index')">All</dropdown-link>
                        <dropdown-link :href="route('contacts.index', {'birthdays': 1})">Birthdays</dropdown-link>
                    </template>
                </dropdown>
            </div>
        </div>

        <div v-if="contacts.data.length > 0">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-white">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Name
                        </th>

                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Phone
                        </th>

                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Birthday
                        </th>

                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                    <tr v-for="contact in contacts.data" :key="contact.id">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-full" :src="contact.profile_photo_url" :alt="contact.name" />
                                </div>

                                <div class="ml-4">
                                    <div class="text-sm font-medium">
                                        <app-link :href="route('contacts.show', [contact])">
                                            <span class="text-gray-800">{{ contact.name }}</span>
                                        </app-link>
                                    </div>

                                    <div class="text-xs text-gray-500">
                                        <a class="text-indigo-500 hover:text-indigo-600" :href="'mailto:'+contact.email">{{ contact.email }}</a>
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-800">{{ contact.phone }}</div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-800">{{ birthday(contact.birthday) }}</div>
                            <div class="text-xs text-gray-500">{{ diffForHumans(contact.birthday, true) }}</div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <dropdown align="right">
                                <template #trigger>
                                    <button class="flex text-sm text-indigo-500 hover:text-indigo-600 focus:text-indigo-600 active:text-indigo-600 focus:outline-none focus:border-indigo-300 transition duration-150 ease-in-out">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                    </button>
                                </template>

                                <template #items>
                                    <dropdown-link :href="route('contacts.edit', [contact])" :active="route().current('contacts.edit')">Edit</dropdown-link>
                                    <dropdown-link @clicked="deleteContact(contact)" href="#">Delete</dropdown-link>
                                </template>
                            </dropdown>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="mt-20">
                <pagination :links="contacts.links"></pagination>
            </div>
        </div>

        <div v-else>
            <span class="text-sm text-gray-500">No contacts found.</span>
        </div>
    </app-layout>
</template>

<script>
import AppInput from '@/Views/Components/Inputs/Input';
import AppButton from '@/Views/Components/Buttons/Button';
import AppLayout from '@/Views/Layouts/AppLayout';
import AppLink from '@/Views/Components/Base/Link';
import Pagination from '@/Views/Components/Pagination/Pagination';
import Dropdown from '@/Views/Components/Dropdowns/Dropdown';
import DropdownLink from '@/Views/Components/Dropdowns/DropdownLink';

export default {
    components: {
        AppLayout,
        Pagination,
        AppInput,
        AppLink,
        Dropdown,
        DropdownLink,
        AppButton,
    },

    props: {
        contacts: Object
    },

    data() {
        return {
            searchForm: this.$inertia.form({
                search: null
            })
        }
    },

    methods: {
        deleteContact(contact) {
            this.$inertia.delete(this.route('contacts.destroy', [contact]));
        }
    }
};
</script>
