<script setup>
import Modal from '@/Components/Modal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { useForm } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';

const props = defineProps({
    schedules: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    animal_id: '',
    symptoms: '',
    date: '',
    time: '',
});

const deleteAddSchedule = ref(false);

const deleteAddSchedules = () => {
    deleteAddSchedule.value = true;

    form.animal_id = props.schedules.animal.id;
    form.symptoms = props.schedules.symptoms;
    form.date = props.schedules.date;
    form.time = props.schedules.time;
};

const deleteSchedule = () => {
    form.delete(route('schedules.destroy', props.schedules.id), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
    });
};

const closeModal = () => {
    deleteAddSchedule.value = false;
};
</script>

<template>
    <section class="space-y-6">
        <PrimaryButton @click="deleteAddSchedules">Delete Schedule</PrimaryButton>

        <Modal :show="deleteAddSchedule" @close="closeModal">
            <div class="p-6">
                <h3 class="text-lg font-medium text-white">Delete Schedule</h3>
                <p class="mt-2 text-gray-500">
                    Are you sure you want to delete this schedule?
                </p>

                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeModal">
                        Cancel
                    </SecondaryButton>

                    <PrimaryButton
                        class="ms-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteSchedule"
                    >
                        Delete Schedule
                    </PrimaryButton>
                </div>
            </div>
        </Modal>
    </section>
</template>
