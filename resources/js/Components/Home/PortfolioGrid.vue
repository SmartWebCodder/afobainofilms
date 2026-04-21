<script setup>
import { Link } from '@inertiajs/vue3';

const projects = [
    {
        couple: 'Adaeze & Chukwuma',
        location: 'NIGERIA',
        venue: 'The George, Lagos, Nigeria',
        type: 'image',
        image: 'https://res.cloudinary.com/dtetfimeq/image/upload/v1776459582/afobaino-films/gallery/afobaino-01.jpg',
        alt: 'Bride and groom wedding portrait by Afobaino Films',
    },
    {
        couple: 'Ifeoma & David',
        location: 'FRANCE',
        venue: 'Château de Vaux, Paris, France',
        type: 'video',
        image: 'https://res.cloudinary.com/dtetfimeq/image/upload/v1776459590/afobaino-films/gallery/afobaino-03.jpg',
        alt: 'Wedding ceremony cinematography in France',
    },
    {
        couple: 'Ngozi & Emeka',
        location: 'ITALY',
        venue: 'Villa Balbiano, Lake Como, Italy',
        type: 'video',
        image: 'https://res.cloudinary.com/dtetfimeq/image/upload/v1776459691/afobaino-films/gallery/afobaino-05.jpg',
        alt: 'Luxury wedding film in Italy',
    },
    {
        couple: 'Amara & Tunde',
        location: 'NIGERIA',
        venue: 'Eko Atlantic, Victoria Island, Nigeria',
        type: 'image',
        image: 'https://res.cloudinary.com/dtetfimeq/image/upload/v1776459594/afobaino-films/gallery/afobaino-04.jpg',
        alt: 'Couple portrait by Afobaino Films',
    },
];
</script>

<template>
    <section class="py-16 md:py-24 px-6 md:px-10 bg-white">
        <div class="max-w-[1300px] mx-auto">
            <!-- 2x2 Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-12">
                <div
                    v-for="project in projects"
                    :key="project.couple"
                    class="group cursor-pointer"
                >
                    <!-- Card -->
                    <div class="relative aspect-[4/3] overflow-hidden bg-surface-container">
                        <img
                            :src="project.image"
                            :alt="project.alt"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                        />
                        <!-- Dark gradient overlay -->
                        <div class="absolute inset-0 bg-gradient-to-b from-black/30 via-transparent to-transparent"></div>

                        <!-- Couple name + Location overlay (top-left) -->
                        <div class="absolute top-5 left-5">
                            <p class="font-serif italic text-white/90 text-sm md:text-base leading-tight">{{ project.couple }}</p>
                            <p class="font-headline text-white text-lg md:text-xl tracking-[0.15em] font-semibold mt-0.5">{{ project.location }}</p>
                        </div>

                        <!-- Play button (for videos) -->
                        <div
                            v-if="project.type === 'video'"
                            class="absolute inset-0 flex items-center justify-center"
                        >
                            <div class="w-14 h-14 md:w-16 md:h-16 rounded-full border-2 border-white bg-white/20 backdrop-blur-sm flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-5 h-5 md:w-6 md:h-6 text-white ml-0.5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Venue text below -->
                    <p class="mt-3 text-center font-sans text-sm text-on-surface-variant tracking-wide">{{ project.venue }}</p>
                </div>
            </div>
        </div>
    </section>
</template>
