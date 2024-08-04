<script setup>
import Modal from '@/Components/Modal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { useForm } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import Select from '@/Components/Select.vue';

const props = defineProps({
    schedules: {
        type: Object,
        required: true,
    },
    animals: {
        type: Object,
        required: true,
    },
});

const editAddSchedule = ref(false);
const animalsOptions = ref([]);
const today = new Date().toISOString().split('T')[0];

onMounted(() => {
    animalsOptions.value = props.animals;
});

const editAddSchedules = () => {
    editAddSchedule.value = true;

    form.animal_id = String(props.schedules.animal_id)
    form.symptoms = props.schedules.symptoms;
    form.date = props.schedules.date;
    form.time = props.schedules.time;

};

const form = useForm({
    animal_id: '',
    symptoms: '',
    date: '',
    time: '',
});

const editSchedule = () => {
    form.put(route('schedules.update', props.schedules.id), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    editAddSchedule.value = false;

    form.reset();
};
</script>

<template>
    <section class="space-y-6">
        <PrimaryButton @click="editAddSchedules">Edit Schedule</PrimaryButton>

        <Modal :show="editAddSchedule" @close="closeModal">
            <div class="p-6">
                <div class="flex flex-col">
                    <InputLabel for="animal_id" value="Select your animal" />

                    <Select
                        id="animal_id"
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
                        @click="editSchedule"
                    >
                        Edit Schedule
                    </PrimaryButton>
                </div>
            </div>
        </Modal>
    </section>
</template>
