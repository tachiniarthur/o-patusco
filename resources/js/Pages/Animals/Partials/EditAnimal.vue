<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { inject, onMounted, ref } from 'vue';
import Select from '@/Components/Select.vue';

const props = defineProps({
    animals: {
        type: Object,
        required: true,
        default: [],
    },
});

const editAddAnimal = ref(false);
const typesAnimals = ref(inject('optionsAnimals'));
const sizeAnimals = ref(inject('optionsSizes'));

const editAddAnimals = () => {
    editAddAnimal.value = true;

    form.name = props.animals.name;
    form.age = props.animals.age;
    form.type = props.animals.type;
    form.breed = props.animals.breed;
    form.weight = props.animals.weight;
    form.size = props.animals.size;

};

const form = useForm({
    name: '',
    age: '',
    type: '',
    breed: '',
    weight: '',
    size: '',
});

const editAnimal = () => {
    form.put(route('animals.update', props.animals.id), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    editAddAnimal.value = false;

    form.reset();
};
</script>

<template>
    <section class="space-y-6">
        <PrimaryButton @click="editAddAnimals">Edit Animal</PrimaryButton>

        <Modal :show="editAddAnimal" @close="closeModal">
            <div class="p-6">
                <div class="flex flex-col">
                    <InputLabel for="name" value="Name" />
    
                    <TextInput
                        id="name"
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
                        @click="editAnimal"
                    >
                        Edit Animal
                    </PrimaryButton>
                </div>
            </div>
        </Modal>
    </section>
</template>
