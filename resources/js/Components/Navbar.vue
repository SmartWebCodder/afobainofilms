<script setup>
import { ref, onMounted, onUnmounted, computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import BookingModal from '@/Components/BookingModal.vue';

const scrolled = ref(false);
const mobileOpen = ref(false);
const showBooking = ref(false);

const navLinks = [
    { name: 'Home', href: '/' },
    { name: 'Videography', href: '/portfolio' },
    { name: 'Contact', href: '/contact' },
    { name: 'About', href: '/about' },
    { name: 'FAQ', href: '/faq' },
];

// Pages with dark hero banners where nav text should be white
const darkHeroPages = ['/portfolio', '/about', '/contact', '/services', '/faq'];
const page = usePage();
const hasDarkHero = computed(() => darkHeroPages.includes(page.url));
const isHome = computed(() => page.url === '/');

// Use dark text when: scrolled OR on a page without dark hero
const useDarkText = computed(() => scrolled.value || !hasDarkHero.value);

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
    <!-- Scrolled sticky nav (appears on scroll for all pages) -->
    <nav
        class="fixed top-0 w-full z-50 transition-all duration-500"
        :class="[
            scrolled ? 'bg-white/95 backdrop-blur-md shadow-sm translate-y-0' : 'md:-translate-y-full bg-white/95 md:bg-transparent'
        ]"
    >
        <div class="max-w-7xl mx-auto flex items-center justify-between px-6 md:px-12 py-4">
            <!-- Mobile: styled logo (same as desktop hero, smaller) -->
            <Link href="/" class="md:hidden inline-flex items-start gap-0">
                <span class="font-headline text-3xl tracking-tight text-primary font-light leading-none mt-1 mr-1">AFOBAINO</span>
                <span class="font-headline text-[7px] tracking-[0.15em] text-primary font-normal leading-none mt-0.5" style="writing-mode: vertical-lr; transform: rotate(180deg);">FILMS</span>
            </Link>

            <!-- Desktop: centered links, no logo -->
            <div class="hidden md:flex items-center justify-center w-full gap-1">
                <template v-for="(link, i) in navLinks" :key="link.name">
                    <Link
                        :href="link.href"
                        class="font-headline uppercase tracking-[0.15em] text-sm transition-colors duration-300 px-4"
                        :class="$page.url === link.href
                            ? 'text-primary'
                            : 'text-on-surface hover:text-primary'"
                    >
                        {{ link.name }}
                    </Link>
                    <span
                        v-if="i < navLinks.length - 1"
                        class="text-sm font-headline select-none text-on-surface/30"
                    >I</span>
                </template>
            </div>

            <!-- Mobile hamburger -->
            <button
                class="md:hidden relative w-8 h-6 flex flex-col justify-between"
                @click="toggleMobile"
                aria-label="Toggle menu"
            >
                <span class="w-full h-0.5 transition-all duration-300 origin-center"
                    :class="[mobileOpen ? 'rotate-45 translate-y-[11px]' : '', 'bg-on-surface']" />
                <span class="w-full h-0.5 transition-opacity duration-300"
                    :class="[mobileOpen ? 'opacity-0' : '', 'bg-on-surface']" />
                <span class="w-full h-0.5 transition-all duration-300 origin-center"
                    :class="[mobileOpen ? '-rotate-45 -translate-y-[11px]' : '', 'bg-on-surface']" />
            </button>
        </div>
    </nav>

    <!-- Static top nav for non-home pages (before scroll, desktop only) -->
    <nav
        v-if="!isHome"
        class="hidden md:block w-full z-40 absolute top-0 transition-opacity duration-300"
        :class="scrolled ? 'opacity-0 pointer-events-none' : 'opacity-100'"
    >
        <div class="max-w-7xl mx-auto flex items-center justify-center px-6 md:px-12 py-5">
            <!-- Desktop: centered links, no logo -->
            <div class="flex items-center justify-center w-full gap-1">
                <template v-for="(link, i) in navLinks" :key="link.name">
                    <Link
                        :href="link.href"
                        class="font-headline uppercase tracking-[0.15em] text-sm transition-colors duration-300 px-4"
                        :class="$page.url === link.href
                            ? 'text-primary'
                            : hasDarkHero ? 'text-white/90 hover:text-primary' : 'text-on-surface hover:text-primary'"
                    >
                        {{ link.name }}
                    </Link>
                    <span
                        v-if="i < navLinks.length - 1"
                        class="text-sm font-headline select-none"
                        :class="hasDarkHero ? 'text-white/30' : 'text-on-surface/30'"
                    >I</span>
                </template>
            </div>
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
            class="fixed inset-0 z-[60] bg-white flex flex-col items-center justify-center gap-8"
        >
            <button
                class="absolute top-5 right-6 w-8 h-6 flex flex-col justify-between"
                @click="closeMobile"
                aria-label="Close menu"
            >
                <span class="w-full h-0.5 bg-on-surface rotate-45 translate-y-[11px] transition-all duration-300 origin-center" />
                <span class="w-full h-0.5 bg-on-surface opacity-0" />
                <span class="w-full h-0.5 bg-on-surface -rotate-45 -translate-y-[11px] transition-all duration-300 origin-center" />
            </button>
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
        </div>
    </Transition>

    <BookingModal :open="showBooking" @close="showBooking = false" />
</template>
