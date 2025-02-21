<script setup>
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    id: {
        type: Number,
        required: true,
    }
})
const form = useForm({
    id : props.id,
});

const deleteTask = form => form.delete(route('tasks.destroy', { task: props.id }))
</script>

<template>
    <button
        @click="deleteTask(form)"
        :disabled="form.processing"
        class="button primary">
        Delete
    </button>
</template>

<style scoped>

</style>
