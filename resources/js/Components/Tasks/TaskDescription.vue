<script setup>
const props = defineProps({
    description: {
        type: String,
        default: '',
    }
})
</script>

<template>
    <div>{{description}}</div>
</template>

<style scoped>

</style>
