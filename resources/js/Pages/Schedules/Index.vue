<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import ListSchedule from '@/Pages/Schedules/Partials/ListSchedules.vue';
import AddSchedule from '@/Pages/Schedules/Partials/AddSchedule.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import Select from '@/Components/Select.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm } from '@inertiajs/vue3';
import { onMounted, provide, ref } from 'vue';

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
    },
    userAuth: {
        type: Object,
        required: true,
    },
    optionsAnimals: {
        type: Array,
        required: true,
    },
});

provide('optionsAnimals', props.optionsAnimals);

const dateInput = ref(null);
const today = new Date().toISOString().split('T')[0];
const typesAnimals = ref(props.optionsAnimals);
const typeInput = ref(null);

const form = useForm({
    date: '',
    type: '',
});

const submitForm = () => {
    form.post(route('schedules.post'), {
        preserveScroll: true,
    });
};
</script>

<template>
    <Head title="Animals" />

    <AuthenticatedLayout
        :user-auth="props.userAuth"
    >
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Schedules</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div v-if="props.userAuth.role != 'doctor'" class="flex justify-end">
                    <AddSchedule :animals="props.animals" />
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 leading-tight mb-4">Filters</h2>

                        <div class="flex gap-4">
                            <div class="flex-1 flex-col">
                                <InputLabel for="date" value="Date" />
    
                                <TextInput
                                    id="date"
                                    ref="dateInput"
                                    v-model="form.date"
                                    type="date"
                                    class="mt-1 block w-full"
                                    :min="today"
                                />
    
                                <InputError :message="form.errors.date" class="mt-2" />
                            </div>
    
                            <div class="flex-1 flex-col">
                                <InputLabel for="type" value="Select type animal" />
    
                                <Select
                                    id="type"
                                    ref="typeInput"
                                    v-model="form.type"
                                    class="mt-1 block w-full"
                                    :options="typesAnimals"
                                />
    
                                <InputError :message="form.errors.date" class="mt-2" />
                            </div>

                            <PrimaryButton class="mt-6" @click="submitForm">Filter</PrimaryButton>
                        </div>
                    </div>
                </div>
        
                <ListSchedule :schedules="props.schedules" :animals="props.animals" :doctors="props.doctors" :user-auth="props.userAuth" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
