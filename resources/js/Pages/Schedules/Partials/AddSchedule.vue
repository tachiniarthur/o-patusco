<script setup>
import Modal from '@/Components/Modal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { useForm } from '@inertiajs/vue3';
import { onMounted, ref, watch } from 'vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import Select from '@/Components/Select.vue';

const props = defineProps({
    animals: {
        type: Object,
        required: true,
    },
});

const confirmAddSchedule = ref(false);
const animalsOptions = ref([]);
const animalIdInput = ref(null);
const symptomsInput = ref(null);
const today = new Date().toISOString().split('T')[0];
const dateInput = ref(null);
const timeInput = ref(null);

onMounted(() => {
    animalsOptions.value = props.animals;
});

const confirmAddSchedules = () => {
    confirmAddSchedule.value = true;
};

const form = useForm({
    animal_id: '',
    symptoms: '',
    date: '',
    time: '',
});

watch(() => form.date, (newDate) => {
    if (newDate && newDate < today) {
        form.date = today;
    }
});

const addSchedule = () => {
    form.post(route('schedules.create'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmAddSchedule.value = false;
    form.reset();
};
</script>

<template>
    <section class="space-y-6">
        <PrimaryButton @click="confirmAddSchedules">Add Schedule</PrimaryButton>

        <Modal :show="confirmAddSchedule" @close="closeModal">
            <div class="p-6">
                <div class="flex flex-col">
                    <InputLabel for="animal_id" value="Select your animal" />

                    <Select
                        id="animal_id"
                        ref="animalIdInput"
                        v-model="form.animal_id"
                        class="mt-1 block w-full"
                        :options="animalsOptions"
                    />
                    
                    <InputError :message="form.errors.animal_id" class="mt-2" />
                </div>

                <div class="flex flex-col mt-6">
                    <InputLabel for="symptoms" value="Symptom" />

                    <TextInput
                        id="symptoms"
                        ref="symptomsInput"
                        v-model="form.symptoms"
                        type="text"
                        class="mt-1 block w-full"
                    />

                    <InputError :message="form.errors.symptoms" class="mt-2" />
                </div>

                <div class="flex flex-col mt-6">
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

                <div class="flex flex-col mt-6">
                    <InputLabel for="time" value="Time" />

                    <TextInput
                        id="time"
                        ref="timeInput"
                        v-model="form.time"
                        type="time"
                        class="mt-1 block w-full"
                    />

                    <InputError :message="form.errors.time" class="mt-2" />
                </div>

                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeModal">
                        Cancel
                    </SecondaryButton>

                    <PrimaryButton
                        class="ms-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="addSchedule"
                    >
                        Add Schedule
                    </PrimaryButton>
                </div>
            </div>
        </Modal>
    </section>
</template>
