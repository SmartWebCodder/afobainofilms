<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';

const videoLoaded = ref(false);

const navLinks = [
    { name: 'Home', href: '/' },
    { name: 'Videography', href: '/portfolio' },
    { name: 'Contact', href: '/contact' },
    { name: 'About', href: '/about' },
    { name: 'FAQ', href: '/faq' },
];
</script>

<template>
    <div>
        <!-- Hero Header: Menu + Logo + Video (Family Films style) -->
        <header class="bg-white">
            <!-- Centered Navigation -->
            <nav class="pt-4 pb-2">
                <div class="flex items-center justify-center gap-1">
                    <template v-for="(link, i) in navLinks" :key="link.name">
                        <Link
                            :href="link.href"
                            class="font-headline uppercase tracking-[0.2em] text-xs md:text-sm transition-colors duration-300 px-3 md:px-5"
                            :class="link.href === '/' ? 'text-primary' : 'text-on-surface hover:text-primary'"
                        >
                            {{ link.name }}
                        </Link>
                        <span
                            v-if="i < navLinks.length - 1"
                            class="text-xs md:text-sm font-headline select-none text-on-surface/30"
                        >I</span>
                    </template>
                </div>
            </nav>

            <!-- Centered Logo -->
            <div class="flex justify-center py-6 md:py-10">
                <Link href="/" class="inline-flex items-start gap-0">
                    <span class="font-headline text-5xl md:text-7xl lg:text-8xl tracking-tight text-primary font-light leading-none">
                        AFOBAINO
                    </span>
                    <span
                        class="font-headline text-sm md:text-base lg:text-lg tracking-[0.2em] text-primary font-normal leading-none mt-1"
                        style="writing-mode: vertical-lr;"
                    >
                        FILMS
                    </span>
                </Link>
            </div>

            <!-- Video/Image -->
            <div class="max-w-6xl mx-auto px-6">
                <div class="relative w-full aspect-[16/9] overflow-hidden">
                <!-- Poster image -->
                <img
                    src="https://res.cloudinary.com/dtetfimeq/image/upload/v1776459594/afobaino-films/gallery/afobaino-04.jpg"
                    alt="Cinematic wedding scene"
                    class="w-full h-full object-cover transition-opacity duration-700"
                    :class="videoLoaded ? 'opacity-0' : 'opacity-100'"
                />
                <!-- Autoplay background video -->
                <video
                    autoplay
                    muted
                    loop
                    playsinline
                    preload="auto"
                    class="absolute inset-0 w-full h-full object-cover transition-opacity duration-700"
                    :class="videoLoaded ? 'opacity-100' : 'opacity-0'"
                    @loadeddata="videoLoaded = true"
                >
                    <source src="https://res.cloudinary.com/dtetfimeq/video/upload/v1776447809/afobaino-films/hero-intro.mp4" type="video/mp4" />
                </video>
                <!-- Dark overlay for text readability -->
                <div class="absolute inset-0 bg-black/30"></div>
                <!-- Overlay text -->
                <div class="absolute inset-0 flex items-center justify-center">
                    <h1 class="font-headline text-4xl md:text-6xl lg:text-7xl text-white leading-[1.3] font-light text-center">
                        Your day.<br />
                        Your story.<br />
                        <span class="italic">Forever.</span>
                    </h1>
                </div>
            </div>
            </div>
        </header>

        <!-- Text Section Below -->
        <section class="bg-white py-16 md:py-24">
            <div class="max-w-3xl mx-auto px-6 text-center">
                <p class="text-on-surface-variant text-base md:text-lg font-light max-w-2xl mx-auto leading-relaxed mb-12">
                    Every love story is unique and it deserves to be told with honesty and intention. Through our films, we go beyond simply capturing moments; we craft heartfelt narratives that reflect the emotions, connections, and essence of your relationship. Your story is our inspiration, and we bring it to life with meaning and care.
                </p>

                <Link
                    href="/contact"
                    class="inline-block border border-on-surface/30 text-on-surface font-headline uppercase tracking-[0.2em] text-xs px-10 py-4 hover:bg-on-surface hover:text-white transition-all duration-300"
                >
                    Contact Us
                </Link>
            </div>
        </section>
    </div>
</template>
