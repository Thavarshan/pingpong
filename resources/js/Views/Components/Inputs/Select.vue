<template>
    <div>
        <input-label :text="label">
            <select :id="id" class="form-input px-4 py-2 mt-1 block w-full rounded-lg bg-white border border-gray-200 focus:outline-none focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 placeholder-gray-400 transition ease-in-out duration-150" @input="$emit('update:modelValue', $event.target.value)" ref="input" :placeholder="placeholder ? placeholder : label">
                <options v-for="(value, key) in options" :key="key" :value="key">{{ value }}</options>
            </select>
        </input-label>

        <input-error :message="error"></input-error>
    </div>
</template>

<script>
import InputLabel from './InputLabel';
import InputError from './InputError';

export default {
    emits: ['update:modelValue'],

    props: {
        error: String,
        modelValue: String,
        label: String,
        placeholder: String,
        id: {
            type: String,
            required: true
        },
        options: {
            type: Object,
            requried: false,
            default: {}
        },
    },

    components: {
        InputLabel,
        InputError,
    },

    methods: {
        focus() {
            this.$refs.input.focus();
        }
    }
}
</script>

