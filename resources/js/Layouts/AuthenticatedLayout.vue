<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';
import Sidebar from './Sidebar.vue';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div class="min-h-screen bg-gray-100">
        <div class="flex">
            <!-- Sidebar -->
            <div class="w-64 min-h-screen bg-white shadow-lg">
                <div class="flex items-center justify-center h-16 border-b">
                    <h1 class="text-xl font-bold">SMKN 1 Punggelan</h1>
                </div>
                <Sidebar />
            </div>

            <!-- Main Content -->
            <div class="flex-1">
                <!-- Header -->
                <header class="bg-white shadow">
                    <div class="px-4 py-6 mx-auto">
                        <slot name="header" />
                    </div>
                </header>

                <!-- Page Content -->
                <main class="p-4">
                    <slot />
                </main>
            </div>
        </div>
    </div>
</template>
