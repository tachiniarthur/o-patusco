<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { inject, ref } from 'vue';
import Select from '@/Components/Select.vue';

const confirmAddAnimal = ref(false);
const typesAnimals = ref(inject('optionsAnimals'));
const sizeAnimals = ref(inject('optionsSizes'));
const nameInput = ref(null);
const ageInput = ref(null);
const typeInput = ref(null);
const breedInput = ref(null);
const weightInput = ref(null);
const sizeInput = ref(null);

const confirmAddAnimals = () => {
    confirmAddAnimal.value = true;
};

const form = useForm({
    name: '',
    age: '',
    type: '',
    breed: '',
    weight: '',
    size: '',
});

const addAnimal = () => {
    form.post(route('animals.create'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmAddAnimal.value = false;

    form.reset();
};
</script>

<template>
    <section class="space-y-6">
        <PrimaryButton @click="confirmAddAnimals">Add Animal</PrimaryButton>

        <Modal :show="confirmAddAnimal" @close="closeModal">
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
                    <InputLabel for="age" value="Age" />
    
                    <TextInput
                        id="age"
                        ref="ageInput"
                        v-model="form.age"
                        type="text"
                        class="mt-1 block w-full"
                    />
    
                    <InputError :message="form.errors.age" class="mt-2" />
                </div>

                <div class="flex flex-col mt-6">
                    <InputLabel for="password" value="Type" />

                    <Select
                        id="type"
                        ref="typeInput"
                        v-model="form.type"
                        class="mt-1 block w-full"
                        :options="typesAnimals"
                    />
    
                    <InputError :message="form.errors.password" class="mt-2" />
                </div>

                <div class="flex flex-col mt-6">
                    <InputLabel for="breed" value="Breed" />
    
                    <TextInput
                        id="breed"
                        ref="breedInput"
                        v-model="form.breed"
                        type="text"
                        class="mt-1 block w-full"
                    />
    
                    <InputError :message="form.errors.breed" class="mt-2" />
                </div>

                <div class="flex flex-col mt-6">
                    <InputLabel for="weight" value="Weight" />
    
                    <TextInput
                        id="weight"
                        ref="weightInput"
                        v-model="form.weight"
                        type="text"
                        class="mt-1 block w-full"
                    />
    
                    <InputError :message="form.errors.weight" class="mt-2" />
                </div>

                <div class="flex flex-col mt-6">
                    <InputLabel for="size" value="Size" />
    
                    <Select
                        id="size"
                        ref="sizeInput"
                        v-model="form.size"
                        class="mt-1 block w-full"
                        :options="sizeAnimals"
                    />
    
                    <InputError :message="form.errors.size" class="mt-2" />
                </div>

                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeModal">
                        Cancel
                    </SecondaryButton>

                    <PrimaryButton
                        class="ms-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="addAnimal"
                    >
                        Add Animal
                    </PrimaryButton>
                </div>
            </div>
        </Modal>
    </section>
</template>
