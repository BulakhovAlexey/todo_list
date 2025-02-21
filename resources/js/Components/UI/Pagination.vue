<script setup>
import { Link } from '@inertiajs/vue3'

const props = defineProps({
    links: {
        type: Array,
        required: true,
    }
})
const getLabel = (label) => {
    if(label.includes('Previous')){
        return label.replace('Previous', '')
    }
    if(label.includes('Next')){
        return label.replace('Next', '')
    }
    return label
}
</script>

<template>
    <div v-if="links.length > 3">
        <div class="flex flex-wrap -mb-1 mt-5 justify-center">
            <template v-for="(link, key) in links">
                <div v-if="link.url === null" :key="key" class="mb-1 mr-1 px-4 py-3 text-gray-400 text-sm leading-4 border rounded" v-html="getLabel(link.label)"/>
                <Link v-else :key="`link-${key}`" class="mb-1 mr-1 px-4 py-3 focus:text-indigo-500 text-sm leading-4 hover:bg-white border focus:border-indigo-500 rounded" :class="{ 'bg-white': link.active }" :href="link.url" v-html="getLabel(link.label)" />
            </template>
        </div>
    </div>
</template>
