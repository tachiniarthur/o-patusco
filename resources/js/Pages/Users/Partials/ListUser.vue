<script setup>
import EditUser from '@/Pages/Users/Partials/EditUser.vue';
import DeleteUser from '@/Pages/Users/Partials/DeleteUser.vue';

const props = defineProps({
    users: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg" v-if="props.users.length > 0">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Role
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="users in props.users" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ users.name }}
                    </th>
                    <td class="px-6 py-4">
                        {{ users.email }}
                    </td>
                    <td class="px-6 py-4">
                        {{ users.role }}
                    </td>
                    <td class="px-6 py-4 flex gap-2">
                        <EditUser :users="users" />
                        <DeleteUser :users="users" />
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div v-else>
        <p class="text-center text-gray-500 dark:text-gray-300">No users found.</p>
    </div>
</template>
