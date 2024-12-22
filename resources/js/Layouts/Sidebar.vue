<template>
    <nav class="mt-4">
        <!-- Dashboard -->
        <Link :href="route('dashboard')" class="menu-item" :class="{ 'active': route().current('dashboard') }">
            <i class="fas fa-home"></i>
            <span>Dashboard</span>
        </Link>

        <!-- Manajemen User -->
        <div class="menu-group">
            <button @click="toggleUserMenu" class="menu-item w-full text-left" :class="{ 'active': route().current('users.*') }">
                <i class="fas fa-users"></i>
                <span>Manajemen User</span>
                <i class="fas transition-transform duration-200" 
                   :class="userMenuOpen ? 'fa-chevron-down rotate-180' : 'fa-chevron-right'"
                ></i>
            </button>
            
            <div v-show="userMenuOpen" class="submenu">
                <Link :href="route('users.teachers')" class="submenu-item" :class="{ 'active': route().current('users.teachers') }">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <span>Guru Mapel</span>
                </Link>
                
                <Link :href="route('users.supervisors')" class="submenu-item" :class="{ 'active': route().current('users.supervisors') }">
                    <i class="fas fa-user-tie"></i>
                    <span>Pembimbing PKL</span>
                </Link>
                
                <Link :href="route('users.picket-teachers')" class="submenu-item" :class="{ 'active': route().current('users.picket-teachers') }">
                    <i class="fas fa-clipboard-list"></i>
                    <span>Guru Piket</span>
                </Link>
                
                <Link :href="route('users.security')" class="submenu-item" :class="{ 'active': route().current('users.security') }">
                    <i class="fas fa-shield-alt"></i>
                    <span>Petugas Keamanan</span>
                </Link>
                
                <Link :href="route('users.administration')" class="submenu-item" :class="{ 'active': route().current('users.administration') }">
                    <i class="fas fa-file-alt"></i>
                    <span>Staf Tata Usaha</span>
                </Link>
                
                <Link :href="route('users.toolman')" class="submenu-item" :class="{ 'active': route().current('users.toolman') }">
                    <i class="fas fa-tools"></i>
                    <span>Tool Man</span>
                </Link>
            </div>
        </div>

        <!-- Menu lainnya -->
    </nav>
</template>

<script setup>
import { ref } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';

const userMenuOpen = ref(false);
const page = usePage();

const toggleUserMenu = () => {
    userMenuOpen.value = !userMenuOpen.value;
};
</script>

<style scoped>
.menu-item {
    @apply flex items-center gap-3 px-4 py-2 text-gray-600 hover:bg-purple-50 hover:text-purple-600 rounded-lg transition-colors duration-200;
}

.menu-item.active {
    @apply bg-purple-50 text-purple-600;
}

.menu-group {
    @apply my-2;
}

.submenu {
    @apply pl-4 mt-1 space-y-1;
}

.submenu-item {
    @apply flex items-center gap-3 px-4 py-2 text-sm text-gray-600 hover:bg-purple-50 hover:text-purple-600 rounded-lg transition-colors duration-200;
}

.submenu-item.active {
    @apply bg-purple-50 text-purple-600;
}

.fas {
    @apply w-5 text-center;
}
</style> 