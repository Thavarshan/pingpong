<template>
    <span>
        <span @click="startConfirmingPassword">
            <slot></slot>
        </span>

        <modal :show="confirmingPassword" @close="confirmingPassword = false">
            <form-card @submitted="confirmPassword">
                <template #form>
                    <div class="p-0">
                        <h5 class="text-gray-800 font-semibold text-lg" v-text="title"></h5>
                    </div>

                    <div class="mt-3 p-0">
                        <div>
                            <p class="text-sm text-gray-600" v-text="content"></p>
                        </div>

                        <div class="mt-6">
                            <app-input type="password" v-model="form.password" :error="form.error" ref="password" label="Password" placeholder="cattleFarmer1576@!"></app-input>
                        </div>
                    </div>
                </template>

                <template #actions>
                    <app-button mode="secondary" type="button" @click.native="confirmingPassword = false">
                        Cancel
                    </app-button>

                    <app-button class="ml-3" mode="primary" type="submit" :class="{ 'opacity-25': form.processing }" :loading="form.processing">
                        Confirm
                    </app-button>
                </template>
            </form-card>
        </modal>
    </span>
</template>

<script>
import axios from 'axios';
import Modal from '@/Views/Components/Modals/Modal';
import AppInput from '@/Views/Components/Inputs/Input';
import AppButton from '@/Views/Components/Buttons/Button';
import FormCard from '@/Views/Components/Cards/FormCard';

export default {
    emits: ['confirmed'],

    props: {
        title: {
            default: 'Confirm Password',
        },

        content: {
            default: 'For your security purposes, please confirm your password to continue.',
        },
    },

    components: {
        Modal,
        AppButton,
        AppInput,
        FormCard,
    },

    data() {
        return {
            confirmingPassword: false,

            form: {
                password: '',
                error: '',
            },
        }
    },

    methods: {
        startConfirmingPassword() {
            axios.get(this.route('password.confirmation')).then(response => {
                if (response.data.confirmed) {
                    this.$emit('confirmed');
                } else {
                    this.confirmingPassword = true;

                    setTimeout(() => this.$refs.password.focus(), 250)
                }
            })
        },

        confirmPassword() {
            this.form.processing = true;

            axios.post(this.route('password.confirm'), {
                password: this.form.password,
            }).then(() => {
                this.form.processing = false;
                this.closeModal();
                this.$nextTick(() => this.$emit('confirmed'));
            }).catch(error => {
                this.form.processing = false;
                this.form.error = error.response.data.errors.password[0];
                this.$refs.password.focus();
            });
        },

        closeModal() {
            this.confirmingPassword = false;
            this.form.password = '';
            this.form.error = '';
        },
    }
}
</script>

