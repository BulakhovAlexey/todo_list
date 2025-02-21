<script setup>
const props = defineProps({
    task: {
        type: Object,
        required: true,
    }
})
</script>

<template>
    <div class="task-detail py-2 flex flex-col gap-5 mb-4">
        <div class="task-detail__name flex items-center gap-2">
            <div class="task-detail__field">Task name:</div>
            <div class="task-detail__value">{{task.name}}</div>
        </div>
        <div class="task-detail__description">
            <div class="task-detail__field">Task description: </div>
            <div class="task-detail__value">{{task.description}}</div>
        </div>
        <div class="task-detail__completed flex items-center gap-2">
            <div class="task-detail__field">Is completed: </div>
            <div class="task-detail__value">{{task.is_completed ? 'Yes' : 'No'}}</div>
        </div>
        <div class="task-detail__tags">
            <div class="task-detail__field mb-2">Tags: </div>
            <div class="task-detail__value flex gap-3">
                <div class="border rounded-md px-3 py-1 bg-gray-100 w-fit" v-for="tag in task.tags" :key="tag.id">
                    {{tag.name}}
                </div>
            </div>
        </div>
        <div class="task-detail__time flex items-center gap-2">
            <div class="task-detail__field">Waiting to complete since: </div>
            <div class="task-detail__value">{{task.created}}</div>
        </div>
    </div>
</template>

<style scoped>
.task-detail__field{
    @apply text-sm;
}
.task-detail__value{
    @apply text-lg;
}
</style>
