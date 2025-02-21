<script setup>
import { Link, usePage } from "@inertiajs/vue3";

const page = usePage();
</script>

<template>
    <div class="flex items-center justify-start gap-3">
        <Link as="button" :class="{ 'active': page.url === '/' }" :href="route('about.index')">About</Link>
        <Link as="button" :class="{ 'active': page.url.startsWith('/tasks') }" :href="route('tasks.index')">Todo List</Link>
    </div>
</template>

<style scoped>
.active{
    @apply font-bold
}
</style>
