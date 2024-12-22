<template>
    <AppLayout title="Perizinan">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Daftar Perizinan
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <!-- Action Buttons -->
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div v-if="$page.props.auth.user.role === 'student'" class="mb-4">
                            <Link :href="route('permissions.create')" 
                                  class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                Ajukan Izin Baru
                            </Link>
                        </div>

                        <!-- Permissions List -->
                        <div class="mt-6">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Tanggal
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Siswa
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Mata Pelajaran
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
                                    <tr v-for="permission in permissions.data" :key="permission.id">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ formatDate(permission.created_at) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ permission.student.name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ permission.subject.name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span :class="getStatusClass(permission.status)">
                                                {{ formatStatus(permission.status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <button @click="showDetail(permission)" 
                                                    class="text-indigo-600 hover:text-indigo-900">
                                                Detail
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <!-- Pagination -->
                            <Pagination :links="permissions.links" class="mt-6" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detail Modal -->
        <Modal :show="showDetailModal" @close="closeDetailModal">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">
                    Detail Perizinan
                </h3>
                <div v-if="selectedPermission" class="space-y-4">
                    <!-- Permission Details -->
                </div>
            </div>
        </Modal>
    </AppLayout>
</template>

<script setup>
import { ref } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue';
import Modal from '@/Components/Modal.vue';

const props = defineProps({
    permissions: Object
});

const showDetailModal = ref(false);
const selectedPermission = ref(null);

const formatDate = (date) => {
    return new Date(date).toLocaleDateString('id-ID');
};

const formatStatus = (status) => {
    const statusMap = {
        'pending': 'Menunggu',
        'approved_by_teacher': 'Disetujui Guru',
        'rejected_by_teacher': 'Ditolak Guru',
        'approved_final': 'Disetujui Final',
        'rejected_final': 'Ditolak Final'
    };
    return statusMap[status] || status;
};

const getStatusClass = (status) => {
    const classes = {
        'pending': 'bg-yellow-100 text-yellow-800',
        'approved_by_teacher': 'bg-blue-100 text-blue-800',
        'rejected_by_teacher': 'bg-red-100 text-red-800',
        'approved_final': 'bg-green-100 text-green-800',
        'rejected_final': 'bg-red-100 text-red-800'
    };
    return `px-2 py-1 text-xs font-medium rounded-full ${classes[status]}`;
};

const showDetail = (permission) => {
    selectedPermission.value = permission;
    showDetailModal.value = true;
};

const closeDetailModal = () => {
    showDetailModal.value = false;
    selectedPermission.value = null;
};
</script> 