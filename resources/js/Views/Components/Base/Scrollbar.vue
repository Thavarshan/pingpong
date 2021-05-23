<template>
    <div ref="element">
        <div class="simplebar-wrapper">
            <div class="simplebar-height-auto-observer-wrapper">
                <div class="simplebar-height-auto-observer"></div>
            </div>

            <div class="simplebar-mask">
                <div class="simplebar-offset">
                    <div class="simplebar-content-wrapper" ref="scrollElement">
                        <div class="simplebar-content" ref="contentElement">
                            <slot></slot>
                        </div>
                    </div>
                </div>
            </div>

            <div class="simplebar-placeholder"></div>
        </div>

        <div class="simplebar-track simplebar-horizontal">
            <div class="simplebar-scrollbar"></div>
        </div>

        <div class="simplebar-track simplebar-vertical">
            <div class="simplebar-scrollbar"></div>
        </div>
    </div>
</template>

<script>
import SimpleBar from 'simplebar';

export default {
    props: {
        autoHide: {
            type: Boolean,
            deafult: true,
            required: false
        },

        clickOnTrack: {
            type: Boolean,
            deafult: true,
            required: false
        },

        timeout: {
            type: Number,
            deafult: 100,
            required: false
        },

        direction: {
            type: String,
            deafult: 'ltr',
            required: false
        }
    },

    mounted() {
        const options = SimpleBar.getOptions({
            autoHide: this.autoHide,
            clickOnTrack: this.clickOnTrack,
            timeout: this.timeout,
            direction: this.direction,
            forceVisible: false
        });

        this.SimpleBar = new SimpleBar(this.$refs.element, options);
    },

    computed: {
        scrollElement() {
            return this.$refs.scrollElement;
        },

        contentElement() {
            return this.$refs.contentElement;
        }
    }
}
</script>
