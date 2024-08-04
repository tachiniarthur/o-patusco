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

const confirmAddUser = ref(false);
const roleOptions = ref([
    { id: 1, name: 'admin' },
    { id: 2, name: 'user' },
    { id: 3, name: 'receptionist' },
    { id: 4, name: 'doctor' },
]);
const nameInput = ref(null);
const emailInput = ref(null);
const roleInput = ref(null);
const passwordInput = ref(null);
const passwordConfirmationInput = ref(null);

const confirmAddUsers = () => {
    confirmAddUser.value = true;
};

const form = useForm({
    name: '',
    email: '',
    role: '',
    password: '',
    password_confirmation: '',
});

const addUser = () => {
    let selectedRole = roleOptions.value.find(role => role.id === Number(form.role));
    form.role = selectedRole ? selectedRole.name : form.role;

    form.post(route('users.create'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmAddUser.value = false;
    form.reset();
};
</script>

<template>
    <section class="space-y-6">
        <PrimaryButton @click="confirmAddUsers">Add User</PrimaryButton>

        <Modal :show="confirmAddUser" @close="closeModal">
            <div class="p-6">
                <div class="flex flex-col">
                    <InputLabel for="name" value="Name" />

                    <TextInput
                        id="name"
                        ref="nameInput"
                        v-model="form.name"
                        type="text"
                        class="mt-1 block w-full"
                    />

                    <InputError :message="form.errors.name" class="mt-2" />
                </div>

                <div class="flex flex-col mt-6">
                    <InputLabel for="email" value="Email" />

                    <TextInput
                        id="email"
                        ref="emailInput"
                        v-model="form.email"
                        type="text"
                        class="mt-1 block w-full"
                    />

                    <InputError :message="form.errors.email" class="mt-2" />
                </div>

                <div class="flex flex-col mt-6">
                    <InputLabel for="role" value="Select role user" />

                    <Select
                        id="role"
                        ref="roleInput"
                        v-model="form.role"
                        class="mt-1 block w-full"
                        :options="roleOptions"
                    />
                    
                    <InputError :message="form.errors.role" class="mt-2" />
                </div>

                <div class="flex flex-col mt-6">
                    <InputLabel for="password" value="Password" />

                    <TextInput
                        id="password"
                        ref="passwordInput"
                        v-model="form.password"
                        type="password"
                        class="mt-1 block w-full"
                    />

                    <InputError :message="form.errors.password" class="mt-2" />
                </div>

                <div class="flex flex-col mt-6">
                    <InputLabel for="password_confirmation" value="Confirm password" />

                    <TextInput
                        id="password_confirmation"
                        ref="passwordConfirmationInput"
                        v-model="form.password_confirmation"
                        type="password"
                        class="mt-1 block w-full"
                    />

                    <InputError :message="form.errors.password_confirmation" class="mt-2" />
                </div>

                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeModal">
                        Cancel
                    </SecondaryButton>

                    <PrimaryButton
                        class="ms-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="addUser"
                    >
                        Add User
                    </PrimaryButton>
                </div>
            </div>
        </Modal>
    </section>
</template>
