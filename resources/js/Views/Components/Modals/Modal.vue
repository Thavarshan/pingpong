<template>
    <teleport to="body">
        <transition leave-active-class="duration-200">
            <div v-show="show" class="fixed top-0 inset-x-0 px-4 pt-8 sm:pt-16 sm:px-0 sm:flex sm:items-top sm:justify-center" scroll-region>
                <transition enter-active-class="ease-out duration-300" enter-class="opacity-0" enter-to-class="opacity-100" leave-active-class="ease-in duration-200" leave-class="opacity-100" leave-to-class="opacity-0">
                    <div v-show="show" class="fixed inset-0 transform transition-all" @click="close">
                        <div class="absolute inset-0 bg-gray-800 opacity-75"></div>
                    </div>
                </transition>

                <transition enter-active-class="ease-out duration-300" enter-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to-class="opacity-100 translate-y-0 sm:scale-100" leave-active-class="ease-in duration-200" leave-class="opacity-100 translate-y-0 sm:scale-100" leave-to-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                    <div v-show="show" class="transform transition-all sm:w-full sm:max-w-xl">
                        <slot v-if="show"></slot>
                    </div>
                </transition>
            </div>
        </transition>
    </teleport>
</template>

<script>
import { onMounted, onUnmounted } from "vue";
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
    },

    watch: {
        show: {
            immediate: true,

            handler: (show) => document.body.style.overflow = show ? 'hidden' : null
        }
    },

    setup(props, { emit }) {
        const close = () => {
            if (props.closeable) {
                this.$emit('close');
            }
        }

        const closeOnEscape = (e) => {
            if (e.key === 'Escape' && props.show) {
                close();
            }
        }

        onMounted(() => document.addEventListener('keydown', closeOnEscape));
        onUnmounted(() => document.removeEventListener('keydown', closeOnEscape));

        return { close }
    },
}
</script>
