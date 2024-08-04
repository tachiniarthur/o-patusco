<script setup>
import { ref, defineProps } from 'vue';

const props = defineProps({
    modelValue: {
        type: String,
        required: true
    },
    id: {
        type: String,
        default: ''
    },
    name: {
        type: String,
        default: ''
    },
    errorMessage: {
        type: String,
        default: ''
    },
    options: {
        type: Array,
        required: true
    }
});

const emit = defineEmits(['update:modelValue']);

const onChange = (event) => {
    emit('update:modelValue', event.target.value);
};
</script>

<template>
    <div>
        <select
            class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-40 dark:focus:ring-blue-500 dark:focus:border-blue-500"
            :id="id"
            :name="name"
            @change="onChange"
            :value="modelValue"
        >
            <option v-for="option in options" :key="option.id" :value="option.id">
                {{ option.name }}
            </option>
        </select>
    </div>
</template>
