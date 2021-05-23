<template>
    <div>
        <input-label :text="label">
            <input autocomplete :type="type" class="form-input px-4 py-2 mt-1 block w-full rounded-lg bg-white border border-gray-200 focus:outline-none focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 placeholder-gray-400 transition ease-in-out duration-150" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input" :placeholder="placeholder ? placeholder : label">
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

        type: {
            type: String,
            default: 'text'
        },

        label: String,
        placeholder: String,
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

