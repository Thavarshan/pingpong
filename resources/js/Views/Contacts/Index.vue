<template>
    <app-layout>
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
                                    <div class="text-sm font-medium text-gray-800">
                                        {{ contact.name }}
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
                            <div class="text-sm text-gray-800">{{ expanded(contact.birthday) }}</div>
                            <div class="text-xs text-gray-500">{{ diffForHumans(contact.birthday) }}</div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <app-link href="#" class="text-indigo-500 hover:text-indigo-600">Edit</app-link>
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
import AppLayout from '@/Views/Layouts/AppLayout';
import AppLink from '@/Views/Components/Base/Link';
import Pagination from '@/Views/Components/Pagination/Pagination';

export default {
    components: {
        AppLayout,
        Pagination,
        AppLink
    },

    props: {
        contacts: Object
    },

    data() {
        return {}
    }
};
</script>
