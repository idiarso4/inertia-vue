<template>
    <div class="qr-scanner">
        <div v-show="!isScanning" class="text-center">
            <button @click="startScanning" 
                    class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                Mulai Scan QR
            </button>
        </div>
        
        <div v-show="isScanning" class="relative">
            <video ref="videoElement" class="w-full rounded-lg"></video>
            <button @click="stopScanning" 
                    class="absolute top-2 right-2 bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600">
                Stop
            </button>
        </div>

        <div v-if="error" class="mt-4 text-red-500">
            {{ error }}
        </div>
    </div>
</template>

<script setup>
import { ref, onUnmounted } from 'vue';
import { QrScanner } from 'qr-scanner'; // Pastikan sudah install package ini

const videoElement = ref(null);
const isScanning = ref(false);
const error = ref(null);
let qrScanner = null;

const emit = defineEmits(['result']);

const startScanning = async () => {
    try {
        error.value = null;
        isScanning.value = true;
        
        qrScanner = new QrScanner(
            videoElement.value,
            result => {
                emit('result', result);
                stopScanning();
            },
            {
                highlightScanRegion: true,
                highlightCodeOutline: true,
            }
        );

        await qrScanner.start();
    } catch (err) {
        error.value = 'Tidak dapat mengakses kamera: ' + err.message;
        isScanning.value = false;
    }
};

const stopScanning = () => {
    if (qrScanner) {
        qrScanner.stop();
        qrScanner.destroy();
        qrScanner = null;
    }
    isScanning.value = false;
};

onUnmounted(() => {
    stopScanning();
});
</script> 