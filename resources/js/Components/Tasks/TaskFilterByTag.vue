<script setup>
import {inject} from "vue";
import TagsList from "@/Components/Tags/TagsList.vue";

const tags = inject("tags");
</script>

<template>
    <div>
        <div class="mb-1">Filter by tag:</div>
        <TagsList :tags="tags"/>
    </div>
</template>

<style scoped>

</style>
