<template>
    <app-layout>
        <div class="md:grid md:grid-cols-12 md:gap-6">
            <div class="md:col-span-7">
                <log-list :logs="logs"></log-list>
            </div>

            <div class="md:col-span-5">
                <div class="grid grid-cols-12 gap-6">
                    <div class="col-span-6">
                        <div class="rounded-xl bg-gray-50 px-4 py-5 px-6">
                            <span class="text-xs">Total Runs</span>

                            <div>
                                <span class="text-4xl">{{ runs }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-6">
                        <div class="rounded-xl bg-gray-50 px-4 py-5 px-6">
                            <span class="text-xs">Contacts</span>

                            <div>
                                <span class="text-4xl">{{ contacts }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Views/Layouts/AppLayout';
import LogList from './LogList'

export default {
    components: {
        AppLayout,
        LogList
    },

    props: ['logs', 'contacts', 'runs']
};
</script>
