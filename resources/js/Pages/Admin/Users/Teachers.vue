<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    teachers: Object
});
</script>

<template>
    <Head title="Guru Mapel" />

    <AdminLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Daftar Guru Mapel
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <!-- Content will go here -->
                        <div class="mb-4">
                            <h3 class="text-lg font-medium text-gray-900">
                                Daftar Guru Mata Pelajaran
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template> 