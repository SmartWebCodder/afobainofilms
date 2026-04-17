<script setup>
import Sidebar from '@/Components/Admin/Sidebar.vue';
</script>

<template>
    <div class="flex min-h-screen bg-surface-dim text-on-surface">
        <Sidebar />
        <main class="ml-64 flex-1">
            <slot />
        </main>
    </div>
</template>
