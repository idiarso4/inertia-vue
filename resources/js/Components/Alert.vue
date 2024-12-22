<template>
    <div v-if="show" 
         :class="[
             'fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg max-w-md transition-all duration-500',
             typeClasses[type]
         ]">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <CheckCircleIcon v-if="type === 'success'" class="h-5 w-5" />
                <ExclamationCircleIcon v-else-if="type === 'error'" class="h-5 w-5" />
                <InformationCircleIcon v-else class="h-5 w-5" />
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium">
                    {{ message }}
                </p>
            </div>
            <div class="ml-auto pl-3">
                <button
                    @click="show = false"
                    class="inline-flex rounded-md p-1.5 hover:bg-black hover:bg-opacity-10"
                >
                    <XMarkIcon class="h-5 w-5" />
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, watch } from 'vue';
import { CheckCircleIcon, ExclamationCircleIcon, InformationCircleIcon, XMarkIcon } from '@heroicons/vue/24/outline';

const props = defineProps({
    message: String,
    type: {
        type: String,
        default: 'info'
    },
    duration: {
        type: Number,
        default: 5000
    }
});

const show = ref(true);
const typeClasses = {
    success: 'bg-green-50 text-green-800',
    error: 'bg-red-50 text-red-800',
    info: 'bg-blue-50 text-blue-800',
    warning: 'bg-yellow-50 text-yellow-800'
};

watch(() => props.message, () => {
    show.value = true;
    if (props.duration > 0) {
        setTimeout(() => {
            show.value = false;
        }, props.duration);
    }
});
</script> 