<script setup>
import Sidebar from '@/Components/Admin/Sidebar.vue';
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';

const sidebarOpen = ref(false);

router.on('navigate', () => {
    sidebarOpen.value = false;
});
</script>

<template>
    <div class="flex min-h-screen bg-surface-dim text-on-surface">
        <Sidebar :open="sidebarOpen" @close="sidebarOpen = false" />

        <button
            type="button"
            class="lg:hidden fixed top-4 left-4 z-50 w-10 h-10 inline-flex items-center justify-center bg-surface border border-outline text-on-surface shadow-sm"
            :aria-expanded="sidebarOpen"
            aria-label="Toggle navigation"
            @click="sidebarOpen = !sidebarOpen"
        >
            <span class="material-symbols-outlined">{{ sidebarOpen ? 'close' : 'menu' }}</span>
        </button>

        <main class="flex-1 lg:ml-64 w-full min-w-0">
            <slot />
        </main>
    </div>
</template>
