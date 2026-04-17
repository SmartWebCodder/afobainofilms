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
    <header class="flex items-center justify-between px-12 py-6 bg-[#201f1f]/80 backdrop-blur-xl sticky top-0 z-30 border-b border-white/5">
        <div>
            <h2 class="text-xl font-headline italic text-white" v-html="title"></h2>
            <p v-if="subtitle" class="text-[10px] font-sans uppercase tracking-widest text-white/40">{{ subtitle }}</p>
        </div>
        <div class="flex items-center space-x-4">
            <Link href="/admin/projects/create" class="flex items-center space-x-2 px-5 py-2 bg-primary text-black text-xs font-bold uppercase tracking-widest hover:bg-primary-light transition-colors">
                <span class="material-symbols-outlined text-lg">add</span>
                <span>New Project</span>
            </Link>
            <button
                @click="router.post('/admin/logout')"
                class="p-2 text-white/50 hover:text-primary transition-colors"
                title="Logout"
            >
                <span class="material-symbols-outlined">logout</span>
            </button>
        </div>
    </header>

    <div v-if="flash?.success" class="mx-12 mt-6 px-4 py-3 bg-success/10 border border-success/20 text-success text-sm">
        {{ flash.success }}
    </div>
</template>
