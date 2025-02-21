<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    task: {
        type: Object,
        required: true,
    }
})
const emits = defineEmits(['showDetailAction'])
const showDetail = (taskId) => {
    emits('showDetailAction', taskId);
}
</script>

<template>
    <div class="cursor-pointer flex items-center hover:opacity-55 transition-all" @click="showDetail(task.id)">
        <div
            class="cursor-pointer p-2 transform rotate-0 transition-all"
        >
            {{ task.is_completed ? '🟢' : '⚪' }}
        </div>
        <div :class="{ completed : task.is_completed }" class="flex-grow">{{task.name}}</div>
    </div>
</template>

<style scoped>
.completed{
    @apply line-through;
}
</style>
