<script setup>
import { Head, Link } from '@inertiajs/vue3';
import GuestLayout from "@/Layouts/GuestLayout.vue";

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
        <h1 class="text-2xl mb-3">Task {{task.id}}</h1>
        <pre>
            {{props.task}}
        </pre>
        <Link class="button secondary" :href="route('tasks.index')">Back</Link>
    </GuestLayout>
</template>
