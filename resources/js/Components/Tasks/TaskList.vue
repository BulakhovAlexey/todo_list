<script setup>
import { usePage } from "@inertiajs/vue3";
import TaskItem from "@/Components/Tasks/TaskItem.vue";

const page = usePage();
const props = defineProps({
    tasks: {
        type: Array,
        required: true,
    }
})

const getEmptyText = () => {
    return page.props.filters.search
        ? `Nothing found for "${page.props.filters.search}"`
        : 'There is no task'
}
</script>

<template>
    <div>
        <Transition name="nested">
            <div v-if="tasks.length > 0" class="task-list flex flex-col gap-10">
                <div v-for="task in tasks" :key="task.id">
                    <TaskItem :task="task" />
                </div>
            </div>
            <div v-else>{{ getEmptyText() }}</div>
        </Transition>
    </div>
</template>

<style scoped>

</style>
