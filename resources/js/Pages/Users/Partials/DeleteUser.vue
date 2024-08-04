<script setup>
import Modal from '@/Components/Modal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { useForm } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';

const props = defineProps({
    users: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    name: '',
    email: '',
    role: '',
});

const deleteAddUser = ref(false);

const deleteAddUsers = () => {
    deleteAddUser.value = true;

    form.animal_id = props.users.animal.id;
    form.symptoms = props.users.symptoms;
    form.date = props.users.date;
    form.time = props.users.time;
};

const deleteUser = () => {
    form.delete(route('users.destroy', props.users.id), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
    });
};

const closeModal = () => {
    deleteAddUser.value = false;
};
</script>

<template>
    <section class="space-y-6">
        <PrimaryButton @click="deleteAddUsers">Delete User</PrimaryButton>

        <Modal :show="deleteAddUser" @close="closeModal">
            <div class="p-6">
                <h3 class="text-lg font-medium text-white">Delete User</h3>
                <p class="mt-2 text-gray-500">
                    Are you sure you want to delete this user?
                </p>

                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeModal">
                        Cancel
                    </SecondaryButton>

                    <PrimaryButton
                        class="ms-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteUser"
                    >
                        Delete User
                    </PrimaryButton>
                </div>
            </div>
        </Modal>
    </section>
</template>
