<script setup>
import { Link } from '@inertiajs/vue3';

const projects = [
    {
        title: 'Midnight in Paris',
        category: 'Short Film',
        aspect: 'aspect-[3/4]',
        offset: '',
        image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuDQgXWTAmgC9nUspCOJXcRThBKIHllZ-L0yjUKMiJREouYNuguwF0h-yful54_4E0jRLQktjNd4eP9dBbh-HB8jXhD3UuSMuxZUwDu_RZWu5WqqV1ZfWiqkCtpv1XydAL-oWW0kky7ZnOy6F81bUpEeV4zVTqnYqbpSgshpl2fI-q5VKaGRFYi_n22P1LXGyyQHfQ6R6TWai1IUuGdhTD_VL9z6Cley6NJNlnlldRiPUbTMUYzSph8f7ybtV54Yko2RyOf3_RhvSjk',
        alt: 'Black and white wedding veil in the wind',
    },
    {
        title: 'Vogue Memories',
        category: 'Editorial',
        aspect: 'aspect-square',
        offset: 'md:mt-12',
        image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuBhTDJbo0-9aGbSHkV8lkpoAmCFkrpy7hKZf-RNSux6lOedtvE2R2gjxYGXsQFFP_LBvZS9aZNqGSN2aG3FggEh3BGL5cAlA4oWUCtgzx8Ey23DzNIOzKSf5hKLCBDyLmx2yaQvQ4iJnGSbIh8FK7BvrIZqoHEwuZvvVN2HGmrQ7qsfZ333L9PaAQCay07v43Q6uq068MHvYitJRlokfILr9dz2OoKF7BrBEC04k3BdL1nL2-gGP19RXu6NWTzJo0DHqHJM08jF-Lw',
        alt: 'Groom in velvet tuxedo under dramatic lighting',
    },
    {
        title: 'Above the Clouds',
        category: 'Documentary',
        aspect: 'aspect-[3/4]',
        offset: '',
        image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuCCC7ep7_aTL2Bl8yNLRt8KAOCF7cg30tHHM47pJuedar2GB3vTc7AmQ_npbioAPlx4dHcMBMpZTummHkX7qpR_M9kSZOCyqhrO_yfBMJ8d_lEEG3XPwQvF-AbOMDzYKV5sl1aS6Ju9Ol6UhdQdaZcr7WP2SLP3GHuUlJHAyQn4Nm93OevHyWJTJzqNK4b5Pq789f1z_IYwfUbODFBu_2aJNV2l6LA87ephh4GKit6aA0ckdmg90ZC8fEIyrCgqrgaX8B70F2JT1zs',
        alt: 'Couple on a mountain peak at sunrise',
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
