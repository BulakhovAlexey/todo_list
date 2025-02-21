<script setup>
import { useSearch } from "@/hooks/useSearch.js";

const { filters, filterByTag } = useSearch();

const props = defineProps({
    tag: {
        type: Object,
        required: true
    },
    isSearch: {
        type: Boolean,
        default: false
    }
})

</script>

<template>
    <div
        class="filter-tag"
        :class="{ active : +filters.tag === +tag.id }"
        @click="filterByTag(tag.id)"
    >{{tag.name}}</div>
</template>

<style scoped>

</style>
