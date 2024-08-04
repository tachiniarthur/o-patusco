<script setup>
import EditSchedule from '@/Pages/Schedules/Partials/EditSchedule.vue';
import DeleteSchedule from '@/Pages/Schedules/Partials/DeleteSchedule.vue';
import AssignDoctor from '@/Pages/Schedules/Partials/AssignDoctor.vue';

const props = defineProps({
    schedules: {
        type: Object,
        required: true,
    },
    animals: {
        type: Object,
        required: true,
    },
    doctors: {
        type: Object,
        required: true,
        default: {}
    },
    userAuth: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg" v-if="props.schedules.length > 0">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Time
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Symptoms
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Name animal
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Type animal
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Doctor
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="schedules in props.schedules" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ schedules.date }}
                    </th>
                    <td class="px-6 py-4">
                        {{ schedules.time }}
                    </td>
                    <td class="px-6 py-4">
                        {{ schedules.symptoms }}
                    </td>
                    <td class="px-6 py-4">
                        {{ schedules.animal.name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ schedules.animal.type }}
                    </td>
                    <td class="px-6 py-4">
                        {{ schedules.doctor ? schedules.doctor.name : 'Dont have doctor' }}
                    </td>
                    <td class="px-6 py-4 flex gap-2">
                        <EditSchedule :schedules="schedules" :animals="props.animals" />
                        <DeleteSchedule v-if="props.userAuth.role != 'doctor'" :schedules="schedules" />
                        <AssignDoctor v-if="props.userAuth.role == 'admin' || props.userAuth.role == 'receptionist'" :schedules="schedules" :doctors="props.doctors" />
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div v-else>
        <p class="text-center text-gray-500 dark:text-gray-300">No schedules found.</p>
    </div>
</template>
