<script setup>
import { Link } from '@inertiajs/vue3';

const projects = [
    {
        title: 'Eternal Frames',
        category: 'Weddings',
        aspect: 'aspect-[3/4]',
        offset: '',
        image: 'https://res.cloudinary.com/dtetfimeq/image/upload/v1776459582/afobaino-films/gallery/afobaino-01.jpg',
        alt: 'Bride and groom wedding portrait by Afobaino Films',
    },
    {
        title: 'Golden Hour',
        category: 'Weddings',
        aspect: 'aspect-square',
        offset: 'md:mt-12',
        image: 'https://res.cloudinary.com/dtetfimeq/image/upload/v1776459590/afobaino-films/gallery/afobaino-03.jpg',
        alt: 'Wedding ceremony golden hour cinematography',
    },
    {
        title: 'Timeless Bond',
        category: 'Weddings',
        aspect: 'aspect-[3/4]',
        offset: '',
        image: 'https://res.cloudinary.com/dtetfimeq/image/upload/v1776459691/afobaino-films/gallery/afobaino-05.jpg',
        alt: 'Couple portrait by Afobaino Films',
    },
];
</script>

<template>
    <section class="py-24 md:py-32 px-6 md:px-12 bg-surface-dim">
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-end mb-20">
                <h3 class="font-headline text-4xl md:text-6xl text-on-surface">The Anthology</h3>
                <div class="hidden md:block w-1/3 h-px bg-outline opacity-50 mb-4"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div
                    v-for="project in projects"
                    :key="project.title"
                    class="group cursor-pointer"
                    :class="project.offset"
                >
                    <div :class="[project.aspect, 'overflow-hidden mb-6 bg-surface-container']">
                        <img
                            :src="project.image"
                            :alt="project.alt"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000"
                        />
                    </div>
                    <div class="flex justify-between items-start">
                        <div>
                            <span class="font-sans text-[10px] uppercase tracking-[0.2em] text-primary mb-2 block">
                                {{ project.category }}
                            </span>
                            <h4 class="font-headline text-2xl group-hover:italic transition-all">
                                {{ project.title }}
                            </h4>
                        </div>
                        <span class="material-symbols-outlined text-primary opacity-0 group-hover:opacity-100 -translate-x-4 group-hover:translate-x-0 transition-all duration-500">
                            arrow_forward
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
