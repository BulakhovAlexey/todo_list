<script setup>
import { useSearch } from "@/hooks/useSearch.js";
import {ref} from "vue";

const { filters, filterBySearch  } = useSearch();

const query = ref(filters.value?.search ?? '')
</script>

<template>
    <form class="flex gap-3 flex-grow">
        <div class="relative w-full">
            <input @input="filterBySearch(query)" class="form__input" v-model="query" placeholder="search.." />
            <span v-show="query.length > 0"  @click="filterBySearch(query, true)" class="reset">&#10005</span>
        </div>
    </form>
</template>

<style scoped>
.form__input{
    @apply flex-grow !pr-[30px];
}
.reset{
    @apply absolute top-0 right-0 cursor-pointer p-2 hover:opacity-50 transition-all
}
.button:disabled{
    @apply opacity-50 pointer-events-none;
}
</style>
