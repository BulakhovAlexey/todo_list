<script setup>
import {ref, watch} from "vue";

const props = defineProps({
    message: {
        type: String,
        default: null,
    }
})

const messageRef = ref(props.message);

watch(() => props.message, (newVal) => {
    if (newVal) {
        messageRef.value = newVal;
        setTimeout(() => messageRef.value = null, 1500);
    }
}, { immediate: true });


</script>

<template>
    <div v-if="messageRef !== null" class="fixed top-0 right-0 bg-green-500 text-white p-3">
        {{messageRef}}
    </div>
</template>

<style scoped>

</style>
