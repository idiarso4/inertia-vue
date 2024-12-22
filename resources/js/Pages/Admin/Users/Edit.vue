<template>
    <AppLayout title="Edit User">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit User
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form @submit.prevent="form.put(route('users.update', user.id))">
                            <div class="grid grid-cols-1 gap-6">
                                <!-- Name -->
                                <div>
                                    <InputLabel for="name" value="Nama" />
                                    <TextInput
                                        id="name"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.name"
                                        required
                                        autofocus
                                    />
                                    <InputError class="mt-2" :message="form.errors.name" />
                                </div>

                                <!-- Email -->
                                <div>
                                    <InputLabel for="email" value="Email" />
                                    <TextInput
                                        id="email"
                                        type="email"
                                        class="mt-1 block w-full"
                                        v-model="form.email"
                                        required
                                    />
                                    <InputError class="mt-2" :message="form.errors.email" />
                                </div>

                                <!-- Role -->
                                <div>
                                    <InputLabel for="role" value="Role" />
                                    <SelectInput
                                        id="role"
                                        class="mt-1 block w-full"
                                        v-model="form.role"
                                        required
                                    >
                                        <option value="">Pilih Role</option>
                                        <option value="admin">Admin</option>
                                        <option value="teacher">Guru</option>
                                        <option value="student">Siswa</option>
                                    </SelectInput>
                                    <InputError class="mt-2" :message="form.errors.role" />
                                </div>
                            </div>

                            <div class="flex items-center justify-end mt-6">
                                <Link
                                    :href="route('users.index')"
                                    class="mr-3"
                                >
                                    Batal
                                </Link>
                                <PrimaryButton :disabled="form.processing">
                                    Update
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
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import SelectInput from '@/Components/SelectInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
    user: Object
});

const form = useForm({
    name: props.user.name,
    email: props.user.email,
    role: props.user.role,
});
</script> 