<script setup>
import Modal from '@/Components/Modal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { useForm } from '@inertiajs/vue3';
import { onMounted, ref, watch } from 'vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import Select from '@/Components/Select.vue';

const props = defineProps({
    schedules: {
        type: Object,
        required: true,
    },
    doctors: {
        type: Object,
        required: true,
    },
});

const confirmAddDoctor = ref(false);
const doctorIdInput = ref(null);
const doctorsOptions = ref(props.doctors);

const confirmAddDoctors = () => {
    confirmAddDoctor.value = true;
};

const form = useForm({
    doctor_id: '',
});

onMounted(() => {
    if (props.schedules.doctor != null) {
        form.doctor_id = String(props.schedules.doctor.id);
    }
});

const addDoctor = () => {
    form.put(route('schedules.update.add-doctor', props.schedules.id), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmAddDoctor.value = false;
    form.reset();
};
</script>

<template>
    <section class="space-y-6">
        <PrimaryButton @click="confirmAddDoctors">Add Doctor</PrimaryButton>

        <Modal :show="confirmAddDoctor" @close="closeModal">
            <div class="p-6">
                <div class="flex flex-col">
                    <InputLabel for="doctor_id" value="Select your doctor" />

                    <Select
                        id="doctor_id"
                        ref="doctorIdInput"
                        v-model="form.doctor_id"
                        class="mt-1 block w-full"
                        :options="doctorsOptions"
                    />
                    
                    <InputError :message="form.errors.doctor_id" class="mt-2" />
                </div>

                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeModal">
                        Cancel
                    </SecondaryButton>

                    <PrimaryButton
                        class="ms-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="addDoctor"
                    >
                        Add Doctor
                    </PrimaryButton>
                </div>
            </div>
        </Modal>
    </section>
</template>
