<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import ListAnimals from '@/Pages/Animals/Partials/ListAnimals.vue';
import AddAnimal from '@/Pages/Animals/Partials/AddAnimal.vue';
import { provide } from 'vue';

const props = defineProps({
    animals: {
        type: Object,
        required: true,
    },
    userAuth: {
        type: Object,
        required: true,
    },
    optionsAnimals: {
        type: Array,
        required: true,
    },
    optionsSizes: {
        type: Array,
        required: true,
    },
});

provide('optionsAnimals', props.optionsAnimals)
provide('optionsSizes', props.optionsSizes)
</script>

<template>
    <Head title="Animals" />

    <AuthenticatedLayout
        :user-auth="props.userAuth"
    >
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Animals</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="flex justify-end">
                    <AddAnimal />
                </div>
        
                <ListAnimals :animals="props.animals" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
