import { useForm } from "@inertiajs/vue3";
import {inject} from "vue";


export const useSearch = () => {

    const routeName = 'tasks.index'

    const filters = inject("filters");

    const formData = {
        search: filters.value?.search ?? null,
        tag: filters.value?.tag ?? null,
    }

    if(filters.value.is_completed !== null){
        formData.is_completed = filters.value.is_completed;
    }

    const applyFilter = (field, value) => {
        const form = useForm(formData)
        form[field] = value;
        form.get(route(routeName));
    }

    const filterByTag = (tagId) => {
        applyFilter('tag', tagId);
    };

    const debounce = (callback, delay) => {
        let timer;
        return (...args) => {
            clearTimeout(timer);
            timer = setTimeout(() => callback(...args), delay);
        };
    };

    const debouncedSearch = debounce((searchTerm) => {
        applyFilter('search', searchTerm);
    }, 1500);

    const filterBySearch = (searchTerm, clear = false) => {
        if (clear) {
            searchTerm = "";
        }
        debouncedSearch(searchTerm);
    };

    const filterByStatus = (isCompleted) => {
        formData.is_completed = isCompleted;
        applyFilter('is_completed', isCompleted);
    };


    return {
        filters,
        filterByTag,
        filterBySearch,
        filterByStatus,
    }
}
