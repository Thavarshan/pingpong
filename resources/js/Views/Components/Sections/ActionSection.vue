<template>
    <div class="md:grid md:grid-cols-12 md:gap-6">
        <action-section-title>
            <template #title><slot name="title"></slot></template>
            <template #description><slot name="description"></slot></template>
        </action-section-title>

        <action-section-content>
            <template #content><slot name="content"></slot></template>
        </action-section-content>
    </div>
</template>

<script>
import ActionSectionTitle from './ActionSectionTitle';
import ActionSectionContent from './ActionSectionContent';

export default {
    components: {
        ActionSectionTitle,
        ActionSectionContent,
    }
}
</script>
