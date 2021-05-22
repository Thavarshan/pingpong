<template>
    <modal :show="show" :closeable="closeable" @close="close">
        <card :has-actions="hasActions">
            <template #content>
                <div class="modal-header p-0">
                    <h5 class="modal-title text-gray-800 font-semibold text-lg">
                        <slot name="title"></slot>
                    </h5>
                </div>

                <div class="modal-body mt-3 p-0">
                    <slot name="content"></slot>
                </div>
            </template>

            <template #actions>
                <slot name="actions"></slot>
            </template>
        </card>
    </modal>
</template>

<script>
import Modal from '@/Views/Components/Modals/Modal';
import Card from '@/Views/Components/Cards/Card';

export default {
    emits: ['close'],

    props: {
        show: {
            default: false
        },

        closeable: {
            default: true
        },

        hasActions: {
            default: false
        }
    },

    components: {
        Card,
        Modal,
    },

    methods: {
        close() {
            this.$emit('close');
        },
    }
}
</script>

