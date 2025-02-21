<script setup>
import { Head, Link } from '@inertiajs/vue3';
import GuestLayout from "@/Layouts/GuestLayout.vue";
import TaskForm from "@/Components/Tasks/TaskForm.vue";

const props = defineProps({
    tags: {
        type: Array,
        required: true,
    }
})

const submit = (form) => {
    form.post(route('tasks.store'))
}

</script>

<template>
    <Head title="Todo list" />
    <GuestLayout>
        <h1 class="text-2xl mb-3">Create task</h1>
        <TaskForm :create="true" :tags="tags" @submitForm="submit" />
        <Link class="button secondary" :href="route('tasks.index')">Back</Link>
    </GuestLayout>
</template>
