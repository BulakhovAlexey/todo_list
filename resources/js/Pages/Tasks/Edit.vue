<script setup>
import { Head, Link } from '@inertiajs/vue3';
import GuestLayout from "@/Layouts/GuestLayout.vue";
import TaskForm from "@/Components/Tasks/TaskForm.vue";

const props = defineProps({
    task: {
        type: Object,
        required: true,
    },
    tags: {
        type: Array,
        required: true,
    }
})

const submit = (form) => {
    form.put(route('tasks.update', { task: props.task.id }))
}

</script>

<template>
    <Head title="Todo list" />
    <GuestLayout>
        <h1 class="text-2xl mb-3">Edit task {{task.id}}</h1>
        <TaskForm :tags="tags" :task="task" @submitForm="submit" />
        <Link class="button secondary" :href="route('tasks.index')">Back</Link>
    </GuestLayout>
</template>
