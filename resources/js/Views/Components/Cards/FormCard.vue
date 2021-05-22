<template>
    <form @submit.prevent="$emit('submitted')">
        <card :has-actions="true">
            <template #content><slot name="form"></slot></template>
            <template #actions><slot name="actions"></slot></template>
        </card>
    </form>
</template>

<script>
import Card from './Card';

export default {
    components: {
        Card,
    }
}
</script>

