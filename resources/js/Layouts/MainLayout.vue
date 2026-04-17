<script setup>
import Navbar from '@/Components/Navbar.vue';
import Footer from '@/Components/Footer.vue';
import WhatsAppFab from '@/Components/WhatsAppFab.vue';
</script>

<template>
    <div class="min-h-screen flex flex-col">
        <Navbar />
        <main class="flex-1">
            <slot />
        </main>
        <Footer />
        <WhatsAppFab />
    </div>
</template>
