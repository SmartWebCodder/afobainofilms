<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';

const scrolled = ref(false);
const mobileOpen = ref(false);

const navLinks = [
    { name: 'Home', href: '/' },
    { name: 'Portfolio', href: '/portfolio' },
    { name: 'About', href: '/about' },
    { name: 'Services', href: '/services' },
    { name: 'Contact', href: '/contact' },
];

function handleScroll() {
    scrolled.value = window.scrollY > 50;
}

function toggleMobile() {
    mobileOpen.value = !mobileOpen.value;
    document.body.style.overflow = mobileOpen.value ? 'hidden' : '';
}

function closeMobile() {
    mobileOpen.value = false;
    document.body.style.overflow = '';
}

onMounted(() => window.addEventListener('scroll', handleScroll));
onUnmounted(() => window.removeEventListener('scroll', handleScroll));
</script>

<template>
    <nav
        class="fixed top-0 w-full z-50 transition-all duration-500"
        :class="scrolled ? 'bg-white/95 backdrop-blur-md shadow-sm' : 'bg-transparent'"
    >
        <div class="max-w-7xl mx-auto flex items-center justify-between px-6 md:px-12 py-5">
            <Link href="/" class="text-2xl font-headline tracking-tight text-primary font-bold">
                AFOBAINO FILMS
            </Link>

            <!-- Desktop links -->
            <div class="hidden md:flex items-center gap-10">
                <Link
                    v-for="link in navLinks"
                    :key="link.name"
                    :href="link.href"
                    class="font-headline uppercase tracking-[0.15em] text-sm transition-colors duration-300"
                    :class="$page.url === link.href
                        ? 'text-primary border-b border-primary pb-1'
                        : scrolled ? 'text-on-surface hover:text-primary' : 'text-white/90 hover:text-primary'"
                >
                    {{ link.name }}
                </Link>
            </div>

            <Link
                href="/contact"
                class="hidden md:inline-block font-headline uppercase tracking-[0.15em] text-sm px-6 py-2 border transition-all duration-300"
                :class="scrolled
                    ? 'border-primary/40 text-primary hover:bg-primary hover:text-white'
                    : 'border-white/40 text-white hover:bg-primary hover:text-white hover:border-primary'"
            >
                Book Now
            </Link>

            <!-- Mobile hamburger -->
            <button
                class="md:hidden relative w-8 h-6 flex flex-col justify-between"
                @click="toggleMobile"
                aria-label="Toggle menu"
            >
                <span
                    class="w-full h-0.5 transition-all duration-300 origin-center"
                    :class="[mobileOpen ? 'rotate-45 translate-y-[11px]' : '', scrolled || mobileOpen ? 'bg-on-surface' : 'bg-white']"
                />
                <span
                    class="w-full h-0.5 transition-opacity duration-300"
                    :class="[mobileOpen ? 'opacity-0' : '', scrolled || mobileOpen ? 'bg-on-surface' : 'bg-white']"
                />
                <span
                    class="w-full h-0.5 transition-all duration-300 origin-center"
                    :class="[mobileOpen ? '-rotate-45 -translate-y-[11px]' : '', scrolled || mobileOpen ? 'bg-on-surface' : 'bg-white']"
                />
            </button>
        </div>
    </nav>

    <!-- Mobile fullscreen overlay -->
    <Transition
        enter-active-class="transition-opacity duration-300"
        enter-from-class="opacity-0"
        enter-to-class="opacity-100"
        leave-active-class="transition-opacity duration-300"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0"
    >
        <div
            v-if="mobileOpen"
            class="fixed inset-0 z-40 bg-white flex flex-col items-center justify-center gap-8"
        >
            <Link
                v-for="(link, i) in navLinks"
                :key="link.name"
                :href="link.href"
                class="font-headline text-3xl uppercase tracking-[0.2em] text-on-surface hover:text-primary transition-colors"
                :style="{ transitionDelay: `${i * 50}ms` }"
                @click="closeMobile"
            >
                {{ link.name }}
            </Link>
            <Link
                href="/contact"
                class="mt-4 px-8 py-3 bg-primary text-white font-headline uppercase tracking-[0.15em] text-sm"
                @click="closeMobile"
            >
                Book Now
            </Link>
        </div>
    </Transition>
</template>
