<template>
    <label :for="id" class="flex items-center cursor-pointer">
        <input :id="id" class="form-checkbox rounded border-gray-300 text-gray-600 shadow-sm focus:border-gray-300 focus:ring focus:ring-gray-200 focus:ring-opacity-50 transition duration-150 ease-in-out" :value="value" v-model="proxyChecked" type="checkbox"/>

        <span class="ml-2 text-sm font-medium leading-5">
            <span v-text="label"></span>
        </span>
    </label>
</template>

<script>
export default {
    emits: ['update:checked'],

    props: {
        id: String,
        label: String,

        value: {
            default: null,
        },

        checked: {
            type: [Array, Boolean],
            default: false,
        },
    },

    computed: {
        proxyChecked: {
            get() {
                return this.checked;
            },

            set(value) {
                this.$emit('update:checked', value);
            },
        },
    },
}
</script>
