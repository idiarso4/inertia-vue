<template>
    <div class="g-sidenav-show bg-gray-100">
        <!-- Sidenav -->
        <ArgonSidenav
            :class="[isRTL ? 'right-0' : 'left-0']"
            :mini="isMini"
            :dark="darkMode"
        >
            <SidenavHeader />
            <SidenavList />
        </ArgonSidenav>

        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg"
              :class="[isRTL ? 'mr-0 ml-0 mr-xl-6' : 'ml-0 mr-0 ml-xl-6']">
            <!-- Navbar -->
            <ArgonNavbar
                :class="[isRTL ? 'px-0 mx-4' : 'px-0 mx-4']"
                :dark="darkMode"
                :mini="isMini"
                @toggle-nav="toggleSidenav"
                @toggle-mini="toggleMini"
            />

            <!-- Content -->
            <div class="container-fluid py-4">
                <slot />
                
                <ArgonFooter />
            </div>
        </main>

        <ArgonConfigurator
            :class="[showConfig ? 'show' : '']"
            :dark="darkMode"
            :rtl="isRTL"
            :mini="isMini"
            @toggle-dark="toggleDarkMode"
            @toggle-nav="toggleSidenav"
            @toggle-rtl="toggleRTL"
            @toggle-mini="toggleMini"
        />
    </div>
</template>

<script setup>
import { ref } from 'vue';
import ArgonSidenav from '@/components/argon/Sidenav/ArgonSidenav.vue';
import ArgonNavbar from '@/components/argon/Navbar/ArgonNavbar.vue';
import ArgonFooter from '@/components/argon/Footer/ArgonFooter.vue';
import ArgonConfigurator from '@/components/argon/Configurator/ArgonConfigurator.vue';
import SidenavHeader from '@/components/Sidenav/SidenavHeader.vue';
import SidenavList from '@/components/Sidenav/SidenavList.vue';

const darkMode = ref(false);
const isRTL = ref(false);
const showConfig = ref(false);
const isMini = ref(false);

const toggleDarkMode = () => darkMode.value = !darkMode.value;
const toggleRTL = () => isRTL.value = !isRTL.value;
const toggleSidenav = () => showConfig.value = !showConfig.value;
const toggleMini = () => isMini.value = !isMini.value;
</script> 