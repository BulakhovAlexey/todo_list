<script setup>
import { useSearch } from "@/hooks/useSearch.js";

const { filterByStatus, filters } = useSearch();

</script>

<template>
    <div>
        <div class="mb-1">Filter by completed:</div>
        <div class="buttons-list gap-3 flex justify-start items-center">
            <div :class="{ active : 1 === parseInt(filters?.is_completed) }" class="button-item" @click="filterByStatus(1)">Completed only</div>
            <div :class="{ active : 0 === parseInt(filters?.is_completed) }" class="button-item" @click="filterByStatus(0)">Not Completed only</div>
        </div>
    </div>
</template>

<style scoped>

</style>
