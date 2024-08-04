<script setup>
import Modal from '@/Components/Modal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { useForm } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';

const props = defineProps({
    animals: {
        type: Object,
        required: true,
        default: [],
    },
});

const typesAnimals = ref([
    { id: 1, name: 'dog' },
    { id: 2, name: 'cat' },
    { id: 3, name: 'bird' },
    { id: 4, name: 'fish' },
    { id: 5, name: 'reptile' },
    { id: 6, name: 'other' },
]);
const sizeAnimals = ref([
    { id: 1, name: 'small' },
    { id: 2, name: 'medium' },
    { id: 3, name: 'large' },
]);

const form = useForm({
    name: '',
    age: '',
    type: '',
    breed: '',
    weight: '',
    size: '',
});

const deleteAddAnimal = ref(false);

const deleteAddAnimals = () => {
    deleteAddAnimal.value = true;

    form.name = props.animals.name;
    form.age = props.animals.age;
    let typeAnimal = typesAnimals.value.find(type => type.name === String(props.animals.type));
    form.type = String(typeAnimal.id);
    form.breed = props.animals.breed;
    form.weight = props.animals.weight;
    let sizeAnimal = sizeAnimals.value.find(size => size.name === String(props.animals.size));
    form.size = String(sizeAnimal.id);
};

const deleteAnimal = () => {
    form.delete(route('animals.destroy', props.animals.id), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
    });
};

const closeModal = () => {
    deleteAddAnimal.value = false;
};
</script>

<template>
    <section class="space-y-6">
        <PrimaryButton @click="deleteAddAnimals">Delete Animal</PrimaryButton>

        <Modal :show="deleteAddAnimal" @close="closeModal">
            <div class="p-6">
                <h3 class="text-lg font-medium text-white">Delete Animal</h3>
                <p class="mt-2 text-gray-500">
                    Are you sure you want to delete this animal?
                </p>

                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeModal">
                        Cancel
                    </SecondaryButton>

                    <PrimaryButton
                        class="ms-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteAnimal"
                    >
                        Delete Animal
                    </PrimaryButton>
                </div>
            </div>
        </Modal>
    </section>
</template>
