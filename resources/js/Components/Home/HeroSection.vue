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
        <!-- Full-screen Hero -->
        <section class="relative w-full h-screen min-h-[500px] overflow-hidden bg-black">

            <!-- Poster image -->
            <img
                src="https://res.cloudinary.com/dtetfimeq/image/upload/v1776459594/afobaino-films/gallery/afobaino-04.jpg"
                alt="Cinematic wedding scene"
                class="absolute inset-0 w-full h-full object-cover transition-opacity duration-700"
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

            <!-- Dark overlay -->
            <div class="absolute inset-0 bg-black/40"></div>

            <!-- Desktop Nav: Logo left, links right -->
            <nav class="absolute top-0 left-0 right-0 z-10 hidden md:flex items-center justify-between px-10 py-6">
                <!-- Logo -->
                <Link href="/" class="inline-flex items-start gap-0" style="font-family: 'Newsreader', serif;">
                    <span class="text-4xl lg:text-5xl tracking-tight text-primary font-light leading-none mr-1 mt-2">AFOBAINO</span>
                    <span
                        class="text-[9px] lg:text-[10px] tracking-[0.2em] text-primary font-normal leading-none mt-1"
                        style="writing-mode: vertical-lr; transform: rotate(180deg);"
                    >FILMS</span>
                </Link>

                <!-- Nav links -->
                <div class="absolute left-1/2 -translate-x-1/2 flex items-center gap-1">
                    <template v-for="(link, i) in navLinks" :key="link.name">
                        <Link
                            :href="link.href"
                            class="font-headline uppercase tracking-[0.2em] text-xs transition-colors duration-300 px-3"
                            :class="link.href === '/' ? 'text-primary' : 'text-white/80 hover:text-primary'"
                        >{{ link.name }}</Link>
                        <span v-if="i < navLinks.length - 1" class="text-xs font-headline select-none text-white/30">I</span>
                    </template>
                </div>
            </nav>

            <!-- Overlay text -->
            <!-- Overlay text -->
            <div class="absolute inset-0 flex flex-col items-center justify-center mt-16 md:mt-0 px-6">
                <h1 class="text-3xl md:text-5xl lg:text-6xl text-white font-light text-center leading-[1.3]" style="font-family: 'Newsreader', serif;">
                    Your day. Your story.<br />
                    <span class="italic">Forever.</span>
                </h1>
                <p class="mt-8 text-white/85 text-sm md:text-base font-light max-w-2xl mx-auto leading-relaxed text-center">
                    Every love story is unique and it deserves to be told with honesty and intention. Through our films, we go beyond simply capturing moments; we craft heartfelt narratives that reflect the emotions, connections, and essence of your relationship. Your story is our inspiration, and we bring it to life with meaning and care.
                </p>
            </div>
        </section>

        <!-- Contact CTA Section -->
        <section class="bg-white py-12 md:py-16">
            <div class="max-w-3xl mx-auto px-6 text-center">
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
