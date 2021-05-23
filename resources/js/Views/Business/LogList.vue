<template>
    <div class="space-y-4">
        <div class="rounded-xl bg-gray-50 px-4 py-5 px-6" v-for="log in logs" :key="log.id">
            <div>
                <div class="flex items-start justify-between">
                    <div>
                        <div>
                            <span class="text-sm text-blue-500 font-medium">{{ log.app_name }}</span>

                            <div>
                                <span class="text-xs text-gray-500">
                                    <time :datetime="log.created_at">{{ diffForHumans(log.created_at) }}</time>
                                </span>
                            </div>
                        </div>

                        <div class="mt-6 px-4 py-2 bg-white rounded-xl">
                            <div v-if="log.status">
                                <div class="mb-3">
                                    <span class="text-xs text-gray-500">Emails sent to</span>
                                </div>

                                <div v-if="log.contacts.length > 0" class="space-y-1">
                                    <div v-for="contact in log.contacts" :key="contact.id">
                                        <div>
                                            <span class="font-medium text-sm text-gray-600">{{ contact.name }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div v-else>
                                    <span class="text-sm">No one</span>
                                </div>
                            </div>

                            <div v-else>
                                <span class="text-sm text-gray-600">{{ log.context }}</span>
                            </div>
                        </div>

                        <div class="mt-6">
                            <span class="text-xs text-gray-500">Initiated</span>

                            <div>
                                <span class="text-gray-600 text-xs font-semibold">
                                    <time :datetime="log.init_time">{{ expanded(log.init_time) }}</time>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <span class="text-xs px-3 py-1 rounded-full font-medium" :class="log.status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'">{{ log.status ? 'Successful' : 'Failed' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['logs']
}
</script>
