<template>
    <AppLayout title="Presensi">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Presensi Mengajar
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <!-- Action Button -->
                        <div class="mb-4">
                            <Link :href="route('attendances.create')" 
                                  class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                Presensi Baru
                            </Link>
                        </div>

                        <!-- Attendances List -->
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tanggal
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Mata Pelajaran
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Kelas
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="attendance in attendances.data" :key="attendance.id">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ formatDateTime(attendance.check_in_time) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ attendance.subject.name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ attendance.class_room.name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span :class="getStatusClass(attendance.status)">
                                            {{ attendance.status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <button v-if="!attendance.check_out_time"
                                                @click="checkOut(attendance)"
                                                class="text-indigo-600 hover:text-indigo-900">
                                            Check Out
                                        </button>
                                        <button @click="showDetail(attendance)"
                                                class="ml-4 text-gray-600 hover:text-gray-900">
                                            Detail
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        <Pagination :links="attendances.links" class="mt-6" />
                    </div>
                </div>
            </div>
        </div>

        <!-- Detail Modal -->
        <Modal :show="showDetailModal" @close="closeDetailModal">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">
                    Detail Presensi
                </h3>
                <div v-if="selectedAttendance" class="space-y-4">
                    <!-- Attendance Details -->
                </div>
            </div>
        </Modal>
    </AppLayout>
</template>

<script setup>
import { ref } from 'vue';
import { Link, useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import Modal from '@/Components/Modal.vue';

const props = defineProps({
    attendances: Object
});

const showDetailModal = ref(false);
const selectedAttendance = ref(null);

const formatDateTime = (datetime) => {
    return new Date(datetime).toLocaleString('id-ID');
};

const getStatusClass = (status) => {
    return status === 'hadir' 
        ? 'px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800'
        : 'px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800';
};

const checkOut = (attendance) => {
    useForm({}).put(route('attendances.update', attendance.id), {
        preserveScroll: true
    });
};

const showDetail = (attendance) => {
    selectedAttendance.value = attendance;
    showDetailModal.value = true;
};

const closeDetailModal = () => {
    showDetailModal.value = false;
    selectedAttendance.value = null;
};
</script> 