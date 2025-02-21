<script setup>

import HeaderLInks from "@/Components/Header/HeaderLInks.vue";
</script>

<template>
    <div class="header__container w-full">
        <div class="header__inner">
            <HeaderLInks />
        </div>
    </div>
</template>

<style scoped>
.header__inner {
    @apply max-w-[800px] mx-auto h-[50px] flex items-center;
}
</style>
