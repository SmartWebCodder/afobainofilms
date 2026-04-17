<script setup>
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const instagramUrl = computed(() => usePage().props.socials?.instagram_url || 'https://www.instagram.com/afobainofilms/');

const images = [
    {
        src: 'https://res.cloudinary.com/dtetfimeq/image/upload/v1776459582/afobaino-films/gallery/afobaino-01.jpg',
        alt: 'Wedding portrait by Afobaino Films',
    },
    {
        src: 'https://res.cloudinary.com/dtetfimeq/image/upload/v1776459585/afobaino-films/gallery/afobaino-02.jpg',
        alt: 'Wedding ceremony cinematography',
    },
    {
        src: 'https://res.cloudinary.com/dtetfimeq/image/upload/v1776459590/afobaino-films/gallery/afobaino-03.jpg',
        alt: 'Golden hour wedding shot',
    },
    {
        src: 'https://res.cloudinary.com/dtetfimeq/image/upload/v1776459594/afobaino-films/gallery/afobaino-04.jpg',
        alt: 'Wedding couple portrait',
    },
    {
        src: 'https://res.cloudinary.com/dtetfimeq/image/upload/v1776459691/afobaino-films/gallery/afobaino-05.jpg',
        alt: 'Wedding day moments',
    },
    {
        src: 'https://res.cloudinary.com/dtetfimeq/image/upload/v1776459695/afobaino-films/gallery/afobaino-06.jpg',
        alt: 'Bride and groom celebration',
    },
];
</script>

<template>
    <section class="relative">
        <a :href="instagramUrl" target="_blank" rel="noopener" class="block">
            <div class="grid grid-cols-2 md:grid-cols-6 w-full">
                <div
                    v-for="img in images"
                    :key="img.alt"
                    class="aspect-square overflow-hidden relative group"
                >
                    <img
                        :src="img.src"
                        :alt="img.alt"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                    />
                    <div class="absolute inset-0 bg-primary/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                        <span class="material-symbols-outlined text-white">camera</span>
                    </div>
                </div>
            </div>
            <div class="absolute inset-0 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity duration-500 bg-black/40">
                <div class="text-center text-white">
                    <span class="material-symbols-outlined text-4xl mb-2">photo_camera</span>
                    <p class="font-sans text-xs uppercase tracking-[0.3em]">Follow us on Instagram</p>
                    <p class="font-headline text-lg mt-1">@afobainofilms</p>
                </div>
            </div>
        </a>
    </section>
</template>
