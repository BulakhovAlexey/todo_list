<script setup>

import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import TaskDelete from "@/Components/Tasks/TaskDelete.vue";

const props = defineProps({
    task: {
        type: Object,
        default: {},
    },
    create: {
        type: Boolean,
        default: false,
    },
    tags: {
        type: Array,
        required: true,
    }
})

const emits = defineEmits(['submitForm'])

const selectedTags = ref(props.task?.tags?.map(tag => tag.id) || []);

const toggleTag = (id) => {
    const index = selectedTags.value.indexOf(id);
    if (index > -1) {
        selectedTags.value.splice(index, 1);
    } else {
        selectedTags.value.push(id);
    }
}
const form = useForm({
    name: props.task.name ?? null,
    description: props.task.description ?? null,
    is_completed: props.task.is_completed ?? false,
    tags: selectedTags,
});

const submitForm = (form) => {
    form.tags = [...selectedTags.value]
    emits('submitForm', form)
}
</script>

<template>
    <form class="form" @submit.prevent="submitForm(form)">
        <div>
            <label for="input-1" class="block text-sm font-medium text-gray-700 dark:text-gray-100">Name</label>
            <div class="relative mt-1">
                <input
                    id="input-1"
                    type="text"
                    v-model="form.name"
                    class="form__input"/>
            </div>
            <div class="text-red-300" v-if="form.errors.name">{{ form.errors.name }}</div>
        </div>
        <div>
            <label for="input-2" class="block text-sm font-medium text-gray-700 dark:text-gray-100">Description</label>
            <div class="relative mt-1">
                    <textarea
                        id="input-2"
                        v-model="form.description"
                        class="form__textarea w-full h-[150px]"
                        cols="10"/>
            </div>
            <div class="text-red-300" v-if="form.errors.description">{{ form.errors.description }}</div>
        </div>

        <div>
            <label class="inline-flex items-center" for="tealCheckBox">
                <input
                    id="tealCheckBox"
                    type="checkbox"
                    class="w-4 h-4 accent-teal-600"
                    v-model="form.is_completed">
                <span class="ml-2">Task is completed</span>
            </label>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-100 mb-2">Tags</label>
            <div class="flex flex-wrap gap-2">
                <div
                    class="inline-block p-1.5 border rounded-xl cursor-pointer"
                    :class="selectedTags.length > 0 && selectedTags.includes(tag.id) ? 'bg-green-300 text-green-800' : 'bg-gray-200 text-gray-800'"
                    v-for="tag in tags"
                    :key="tag.id"
                    @click="toggleTag(tag.id)">
                    {{ tag.name }}
                </div>
            </div>
        </div>

        <div class="flex justify-center gap-3">
            <button
                type="submit"
                :disabled="form.processing"
                :class="{ disabled: form.processing }"
                class="button primary">
                {{ props.create ? "Create" : "Edit" }}
            </button>
            <TaskDelete v-if="!props.create" :id="props.task.id" />
        </div>

    </form>
</template>

<style scoped>
.disabled{
    @apply pointer-events-none opacity-50
}
</style>
