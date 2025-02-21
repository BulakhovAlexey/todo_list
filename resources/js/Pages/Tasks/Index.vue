<script setup>
import { Head, usePage, Link } from '@inertiajs/vue3';
import GuestLayout from "@/Layouts/GuestLayout.vue";
import TaskList from "@/Components/Tasks/TaskList.vue";
import {provide, ref} from "vue";
import Notification from "@/Components/UI/Notification.vue";
import Pagination from "@/Components/UI/Pagination.vue";
import TaskSearch from "@/Components/Tasks/TaskSearch.vue";
import TasksFilters from "@/Components/Tasks/TasksFilters.vue";
import { useClearSearch } from "@/hooks/useClearSearch.js";

const page = usePage();
const message = ref(page.props.flash.success)
const props = defineProps({
    tasks: {
        type: Object,
        required: true,
    },
    tags: {
        type: Array,
        required: true,
    },
    filters: {
        type: Object,
        required: true,
    }
})

const tags = ref(props.tags);
provide('tags', tags);

const filters = ref(props.filters);
const hasParams = () => {
    return Object.values(filters.value).some((el) => el !== null)
};
provide('filters', filters);

const tasksRef = ref([]);
tasksRef.value = props.tasks.data;

const { clearAll } = useClearSearch()

</script>

<template>
    <Head title="Tasks list" />
    <GuestLayout>
        <div class="flex justify-center items-center gap-1 mb-3">
            <h1 class="text-2xl text-center flex-grow">Todo List</h1>
            <Link class="button primary text-xs pt-1 bg-green-200" :href="route('tasks.create')">+</Link>
        </div>
        <div class="flex flex-col gap-5 mb-3 relative pb-[45px]">
            <TasksFilters />
            <TaskSearch />
            <button v-show="hasParams()" class="block button-item max-w-[150px] absolute bottom-0 left-0" @click="clearAll">Clear filters</button>
        </div>
        <TaskList :tasks="tasksRef" />
        <Pagination :links="tasks.links" />
        <Notification :message="message" />
    </GuestLayout>
</template>

<style scoped>
</style>
