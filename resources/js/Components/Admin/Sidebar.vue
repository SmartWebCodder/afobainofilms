<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

defineProps({
    open: { type: Boolean, default: false },
});

defineEmits(['close']);

const page = usePage();
const currentUrl = computed(() => page.url);
const user = computed(() => page.props.auth?.user);

const navItems = [
    { label: 'Dashboard', icon: 'dashboard', route: '/admin' },
    { label: 'Portfolio', icon: 'view_carousel', route: '/admin/projects' },
    { label: 'Testimonials', icon: 'format_quote', route: '/admin/testimonials' },
    { label: 'Messages', icon: 'mail', route: '/admin/messages' },
    { label: 'Settings', icon: 'settings', route: '/admin/settings' },
];

function isActive(route) {
    if (route === '/admin') return currentUrl.value === '/admin';
    return currentUrl.value.startsWith(route);
}
</script>

<template>
    <div
        v-if="open"
        class="lg:hidden fixed inset-0 bg-black/40 z-30"
        @click="$emit('close')"
    ></div>

    <aside
        class="w-64 bg-surface border-r border-outline flex flex-col fixed inset-y-0 left-0 z-40 transition-transform duration-300 lg:translate-x-0"
        :class="open ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
    >
        <div class="px-8 py-10">
            <Link href="/" class="block">
                <h1 class="text-2xl font-headline tracking-tighter text-primary">AFOBAINO</h1>
                <p class="text-[10px] font-sans uppercase tracking-widest text-on-surface-muted mt-1">Admin Panel</p>
            </Link>
        </div>

        <nav class="flex-1 px-4 space-y-1">
            <Link
                v-for="item in navItems"
                :key="item.route"
                :href="item.route"
                class="flex items-center space-x-3 px-4 py-3 transition-all duration-200"
                :class="isActive(item.route)
                    ? 'bg-surface-container text-primary'
                    : 'text-on-surface-variant hover:text-primary'"
            >
                <span class="material-symbols-outlined" :style="isActive(item.route) ? `font-variation-settings: 'FILL' 1` : ''">{{ item.icon }}</span>
                <span class="text-sm font-sans uppercase tracking-wider">{{ item.label }}</span>
            </Link>
        </nav>

        <div class="p-6 border-t border-outline">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-surface-container flex items-center justify-center text-xs font-bold text-primary">
                    {{ user?.name?.charAt(0) ?? 'A' }}
                </div>
                <div>
                    <p class="text-xs font-bold uppercase text-on-surface">{{ user?.name ?? 'Admin' }}</p>
                    <p class="text-[10px] text-primary/70">Administrator</p>
                </div>
            </div>
        </div>
    </aside>
</template>
