<script setup>
import EditAnimal from '@/Pages/Animals/Partials/EditAnimal.vue';
import DeleteAnimal from '@/Pages/Animals/Partials/DeleteAnimal.vue';

const props = defineProps({
    animals: {
        type: Array,
        required: true,
        default: [],
    },
});
</script>

<template>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg" v-if="props.animals.length > 0">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Age
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Type
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Breed
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Weight
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Size
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="animals in props.animals" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ animals.name }}
                    </th>
                    <td class="px-6 py-4">
                        {{ animals.age }}
                    </td>
                    <td class="px-6 py-4">
                        {{ animals.type }}
                    </td>
                    <td class="px-6 py-4">
                        {{ animals.breed }}
                    </td>
                    <td class="px-6 py-4">
                        {{ animals.weight }}
                    </td>
                    <td class="px-6 py-4">
                        {{ animals.size }}
                    </td>
                    <td class="px-6 py-4 flex gap-2">
                        <EditAnimal :animals="animals" />
                        <DeleteAnimal :animals="animals" />
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div v-else>
        <p class="text-center text-gray-500 dark:text-gray-300">No animals found.</p>
    </div>
</template>
