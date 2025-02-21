<script setup>
import HeaderIndex from "@/Components/Header/HeaderIndex.vue";
</script>

<template>
    <HeaderIndex />
    <div class="container max-w-[800px] mx-auto p-[25px] bg-blue-100 mt-10">
        <slot />
    </div>
</template>

<style scoped>

</style>
