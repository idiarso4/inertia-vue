<template>
    <div class="w-auto h-auto">
        <ul class="navbar-nav">
            <li class="nav-item">
                <Link :href="route('dashboard')"
                      class="nav-link"
                      :class="{ active: route().current('dashboard') }">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="ni ni-shop text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </Link>
            </li>

            <li class="nav-item">
                <Link :href="route('users.index')"
                      class="nav-link"
                      :class="{ active: route().current('users.*') }">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-02 text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Users</span>
                </Link>
            </li>

            <!-- Tambahkan menu lainnya -->
        </ul>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script> 