import { useForm } from "@inertiajs/vue3";

export const useClearSearch = () => {

    const form = useForm({})
    const routName = 'tasks.index'
    const clearAll = () => {
        form.get(route(routName))
    }

    return {
        clearAll
    }
}
