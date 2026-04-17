<script setup>
import { Link } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';

const videoLoaded = ref(false);
</script>

<template>
    <header class="relative h-screen w-full flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <!-- Poster image shown while video loads -->
            <img
                src="https://lh3.googleusercontent.com/aida-public/AB6AXuAlgEG__lTPaKgIjnUj40j2PC75HTfbgSAevEnwDhzmVN_Y1BT16fqgdG2lT35S21yIXCzIPbMywiqIRTW1EqoH-ZZK65SK8SAjE2fdp61yOHZ8ONqJAMLdv03DmVsB9UvIWZllU3CCC_sv4UmEvY2JZ7Ga0jdl1_jKgLW-3jYHPCi5UrcqLi6I8Lvh9L-nVz2jxYU6q0LQ0tXCA3EhKs5Cv34Tq4BZaIZFMkzKMM-_hW4_10Rwpwc61Gyctg4lQKfh1WfOIkxkSyI"
                alt="Cinematic wedding scene with soft lens flare"
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
            <div class="absolute inset-0 bg-black/60"></div>
        </div>

        <div class="relative z-10 text-center px-4 max-w-4xl">
            <span class="font-sans text-primary uppercase tracking-[0.4em] text-xs md:text-sm mb-6 block opacity-90">
                CINEMATOGRAPHY &bull; PHOTOGRAPHY &bull; STORYTELLING
            </span>

            <h1 class="font-headline text-5xl md:text-8xl text-white mb-8 leading-[1.1] font-light">
                We Don't Just Film. <br /><span class="italic">We Feel.</span>
            </h1>

            <p class="text-white/70 text-lg md:text-xl font-light mb-10 max-w-2xl mx-auto leading-relaxed">
                Capturing the invisible threads that bind moments together. A digital auteur approach to your most precious narratives.
            </p>

            <div class="flex flex-col md:flex-row items-center justify-center gap-6">
                <Link
                    href="/portfolio"
                    class="bg-primary text-white font-bold uppercase tracking-widest text-xs px-10 py-5 rounded-lg hover:shadow-[0_0_20px_rgba(201,168,76,0.3)] transition-all duration-500"
                >
                    View Our Work
                </Link>
                <a
                    href="#featured-reel"
                    class="border border-primary/40 text-primary font-bold uppercase tracking-widest text-xs px-10 py-5 hover:bg-primary/10 transition-all duration-500 flex items-center gap-2"
                >
                    <span class="material-symbols-outlined">play_circle</span>
                    Play Showreel
                </a>
            </div>
        </div>
    </header>
</template>
