<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();
const currentUrl = computed(() => page.url);
const user = computed(() => page.props.auth?.user);

const navItems = [
    { label: 'Dashboard', icon: 'dashboard', route: '/admin' },
    { label: 'Portfolio', icon: 'view_carousel', route: '/admin/projects' },
    { label: 'Messages', icon: 'mail', route: '/admin/messages' },
    { label: 'Settings', icon: 'settings', route: '/admin/settings' },
];

function isActive(route) {
    if (route === '/admin') return currentUrl.value === '/admin';
    return currentUrl.value.startsWith(route);
}
</script>

<template>
    <aside class="w-64 bg-[#1c1b1b] border-r border-white/5 flex flex-col fixed h-full z-40">
        <div class="px-8 py-10">
            <Link href="/" class="block">
                <h1 class="text-2xl font-headline tracking-tighter text-primary">AFOBAINO</h1>
                <p class="text-[10px] font-sans uppercase tracking-widest text-white/40 mt-1">Admin Panel</p>
            </Link>
        </div>

        <nav class="flex-1 px-4 space-y-1">
            <Link
                v-for="item in navItems"
                :key="item.route"
                :href="item.route"
                class="flex items-center space-x-3 px-4 py-3 transition-all duration-200"
                :class="isActive(item.route)
                    ? 'bg-white/5 text-primary'
                    : 'text-white/50 hover:text-primary'"
            >
                <span class="material-symbols-outlined" :style="isActive(item.route) ? `font-variation-settings: 'FILL' 1` : ''">{{ item.icon }}</span>
                <span class="text-sm font-sans uppercase tracking-wider">{{ item.label }}</span>
            </Link>
        </nav>

        <div class="p-6 border-t border-white/5">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-white/10 flex items-center justify-center text-xs font-bold text-primary">
                    {{ user?.name?.charAt(0) ?? 'A' }}
                </div>
                <div>
                    <p class="text-xs font-bold uppercase text-white">{{ user?.name ?? 'Admin' }}</p>
                    <p class="text-[10px] text-primary/70">Administrator</p>
                </div>
            </div>
        </div>
    </aside>
</template>
