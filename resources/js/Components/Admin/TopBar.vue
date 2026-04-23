<script setup>
import { Link, router, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

defineProps({
    title: { type: String, default: 'Dashboard' },
    subtitle: { type: String, default: '' },
});

const page = usePage();
const flash = computed(() => page.props.flash);
</script>

<template>
    <header class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between pl-16 pr-4 sm:px-6 lg:px-12 py-4 sm:py-6 bg-surface/80 backdrop-blur-xl sticky top-0 z-20 border-b border-outline">
        <div class="min-w-0">
            <h2 class="text-lg sm:text-xl font-headline italic text-on-surface" v-html="title"></h2>
            <p v-if="subtitle" class="text-[10px] font-sans uppercase tracking-widest text-on-surface-muted">{{ subtitle }}</p>
        </div>
        <div class="flex items-center gap-3 sm:gap-4 w-full sm:w-auto justify-between sm:justify-end">
            <Link href="/admin/projects/create" class="flex items-center space-x-2 px-4 sm:px-5 py-2 bg-primary text-white text-[10px] sm:text-xs font-bold uppercase tracking-widest hover:bg-primary-light transition-colors">
                <span class="material-symbols-outlined text-lg">add</span>
                <span>New Project</span>
            </Link>
            <button
                @click="router.post('/admin/logout')"
                class="p-2 text-on-surface-variant hover:text-primary transition-colors"
                title="Logout"
            >
                <span class="material-symbols-outlined">logout</span>
            </button>
        </div>
    </header>

    <div v-if="flash?.success" class="mx-4 sm:mx-6 lg:mx-12 mt-4 sm:mt-6 px-4 py-3 bg-success/10 border border-success/20 text-success text-sm">
        {{ flash.success }}
    </div>
</template>
