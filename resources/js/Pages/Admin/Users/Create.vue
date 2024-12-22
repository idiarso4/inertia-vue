<template>
    <AppLayout title="Tambah User">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Tambah User
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form @submit.prevent="form.post(route('users.store'))">
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

                                <!-- Password -->
                                <div>
                                    <InputLabel for="password" value="Password" />
                                    <TextInput
                                        id="password"
                                        type="password"
                                        class="mt-1 block w-full"
                                        v-model="form.password"
                                        required
                                        autocomplete="new-password"
                                    />
                                    <InputError class="mt-2" :message="form.errors.password" />
                                </div>

                                <!-- Confirm Password -->
                                <div>
                                    <InputLabel for="password_confirmation" value="Konfirmasi Password" />
                                    <TextInput
                                        id="password_confirmation"
                                        type="password"
                                        class="mt-1 block w-full"
                                        v-model="form.password_confirmation"
                                        required
                                    />
                                    <InputError class="mt-2" :message="form.errors.password_confirmation" />
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
                                    Simpan
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

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    role: '',
});
</script> 