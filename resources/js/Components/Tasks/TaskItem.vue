<script setup>
import { Link } from "@inertiajs/vue3";
import {ref} from "vue";
import TagsList from "@/Components/Tags/TagsList.vue";
import TaskDescription from "@/Components/Tasks/TaskDescription.vue";
import TaskMainInfo from "@/Components/Tasks/TaskMainInfo.vue";
import TaskDelete from "@/Components/Tasks/TaskDelete.vue";

const props = defineProps({
    task: {
        type: Object,
        required: true,
    }
})

const visibleIndex = ref(null)
const isVisible = (id) => {
    return visibleIndex.value === id
}
const toggleOpen = (taskId) => {
    visibleIndex.value === taskId
        ? visibleIndex.value = null
        : visibleIndex.value = taskId
}

</script>

<template>
    <div class="border rounded-md p-4 border-gray-300 w-full">
        <div class="flex justify-start items-center">
            <TaskMainInfo @showDetailAction="toggleOpen" :task="task" class="flex-grow" />
            <Link class="p-2 cursor-pointer" :href="route('tasks.edit', task.id)">✏️</Link>
        </div>
        <div v-if="isVisible(task.id)" class="flex flex-col gap-2 border-gray-400 rounded-md border p-3">
            <TaskDescription :description="task.description" />
            <TagsList :tags="task.tags" />
            <Link class="border py-1 px-2 rounded-md bg-gray-100 my-0 hover:opacity-50 transition-all cursor-pointer ml-auto" :href="route('tasks.show', task.id)">To detail</Link>
        </div>
    </div>
</template>

<style scoped>
.open {
    @apply transform rotate-180 transition-transform duration-300
}
</style>
