<template>
    <AppLayout title="Ajukan Izin">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Ajukan Izin Baru
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="submit" class="space-y-6">
                            <div>
                                <InputLabel for="subject_id" value="Mata Pelajaran" />
                                <select v-model="form.subject_id" 
                                        id="subject_id"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                    <option value="">Pilih Mata Pelajaran</option>
                                    <option v-for="subject in subjects" 
                                            :key="subject.id" 
                                            :value="subject.id">
                                        {{ subject.name }}
                                    </option>
                                </select>
                                <InputError :message="form.errors.subject_id" class="mt-2" />
                            </div>

                            <div>
                                <InputLabel for="reason" value="Alasan Izin" />
                                <textarea v-model="form.reason"
                                          id="reason"
                                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                          rows="4">
                                </textarea>
                                <InputError :message="form.errors.reason" class="mt-2" />
                            </div>

                            <div>
                                <InputLabel for="proof_file" value="Bukti (Opsional)" />
                                <input type="file"
                                       @input="form.proof_file = $event.target.files[0]"
                                       class="mt-1 block w-full" />
                                <InputError :message="form.errors.proof_file" class="mt-2" />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <PrimaryButton :class="{ 'opacity-25': form.processing }" 
                                             :disabled="form.processing">
                                    Ajukan Izin
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
    subjects: Array,
    classRooms: Array
});

const form = useForm({
    subject_id: '',
    class_room_id: '',
    reason: '',
    proof_file: null
});

const submit = () => {
    form.post(route('permissions.store'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
        }
    });
};
</script> 