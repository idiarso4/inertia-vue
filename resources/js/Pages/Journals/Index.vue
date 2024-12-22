<template>
    <AppLayout title="Jurnal PKL">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Jurnal PKL
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <!-- Action Button for Students -->
                        <div v-if="$page.props.auth.user.role === 'student'" class="mb-4">
                            <button @click="showCreateModal = true"
                                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                Tambah Jurnal
                            </button>
                        </div>

                        <!-- Journals List -->
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
                                        Status
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="journal in journals.data" :key="journal.id">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ formatDate(journal.activity_date) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ journal.student.name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span :class="getStatusClass(journal.status)">
                                            {{ formatStatus(journal.status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <button @click="showDetail(journal)"
                                                class="text-indigo-600 hover:text-indigo-900">
                                            Detail
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        <Pagination :links="journals.links" class="mt-6" />
                    </div>
                </div>
            </div>
        </div>

        <!-- Create/Edit Modal -->
        <Modal :show="showCreateModal" @close="closeCreateModal">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">
                    {{ editingJournal ? 'Edit Jurnal' : 'Tambah Jurnal' }}
                </h3>
                <form @submit.prevent="submit" class="space-y-4">
                    <!-- Form fields -->
                </form>
            </div>
        </Modal>

        <!-- Detail Modal -->
        <Modal :show="showDetailModal" @close="closeDetailModal">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">
                    Detail Jurnal
                </h3>
                <div v-if="selectedJournal" class="space-y-4">
                    <!-- Journal Details -->
                </div>
            </div>
        </Modal>
    </AppLayout>
</template>

<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import Modal from '@/Components/Modal.vue';
import Pagination from '@/Components/Pagination.vue';

const props = defineProps({
    journals: Object
});

const showCreateModal = ref(false);
const showDetailModal = ref(false);
const selectedJournal = ref(null);
const editingJournal = ref(null);

const form = useForm({
    activity_date: '',
    activity_description: '',
    documentation: null
});

const formatDate = (date) => {
    return new Date(date).toLocaleDateString('id-ID');
};

const formatStatus = (status) => {
    const statusMap = {
        'draft': 'Draft',
        'submitted': 'Diajukan',
        'approved': 'Disetujui',
        'rejected': 'Ditolak'
    };
    return statusMap[status] || status;
};

const getStatusClass = (status) => {
    const classes = {
        'draft': 'bg-gray-100 text-gray-800',
        'submitted': 'bg-yellow-100 text-yellow-800',
        'approved': 'bg-green-100 text-green-800',
        'rejected': 'bg-red-100 text-red-800'
    };
    return `px-2 py-1 text-xs font-medium rounded-full ${classes[status]}`;
};

const submit = () => {
    if (editingJournal.value) {
        form.put(route('journals.update', editingJournal.value.id), {
            onSuccess: () => closeCreateModal()
        });
    } else {
        form.post(route('journals.store'), {
            onSuccess: () => closeCreateModal()
        });
    }
};

const showDetail = (journal) => {
    selectedJournal.value = journal;
    showDetailModal.value = true;
};

const closeCreateModal = () => {
    showCreateModal.value = false;
    editingJournal.value = null;
    form.reset();
};

const closeDetailModal = () => {
    showDetailModal.value = false;
    selectedJournal.value = null;
};
</script> 