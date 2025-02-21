<script setup>
import { Head, Link } from '@inertiajs/vue3';
import GuestLayout from "@/Layouts/GuestLayout.vue";
import TaskDetail from "@/Components/Tasks/TaskDetail.vue";

const props = defineProps({
    task: {
        type: Object,
        required: true,
    },

})


</script>

<template>
    <Head title="Todo list" />
    <GuestLayout>
        <h1 class="text-2xl mb-3">Task #{{task.id}}</h1>
        <TaskDetail :task="props.task" />
        <Link class="button secondary" :href="route('tasks.index')">Back</Link>
    </GuestLayout>
</template>
