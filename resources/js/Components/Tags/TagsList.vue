<script setup>

import TagItem from "@/Components/Tags/TagItem.vue";

const props = defineProps({
    tags: {
        type: Array,
        default: () => [],
    }
})
</script>

<template>
    <div class="flex gap-3.5 flex-wrap">
        <div
            v-for="tag in props.tags"
            :key="tag.id"
            class="tag">
            <TagItem :tag="tag" :isSearch="true" />
        </div>
    </div>
</template>

<style scoped>

</style>
