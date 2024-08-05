<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import ListUser from '@/Pages/Users/Partials/ListUser.vue';
import AddUser from '@/Pages/Users/Partials/AddUser.vue';
import { provide } from 'vue';

const props = defineProps({
    users: {
        type: Object,
        required: true,
    },
    userAuth: {
        type: Object,
        required: true,
    },
    optionsRoles: {
        type: Array,
        required: true,
    },
});

provide('optionsRoles', props.optionsRoles)
</script>

<template>
    <Head title="Users" />

    <AuthenticatedLayout
        :user-auth="props.userAuth"
    >
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Users</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="flex justify-end">
                    <AddUser />
                </div>
        
                <ListUser :users="props.users" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
