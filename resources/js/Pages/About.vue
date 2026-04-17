<script setup>
import { Link } from '@inertiajs/vue3';

const stats = [
    { value: '150+', label: 'Films' },
    { value: '8+', label: 'Years' },
    { value: '200+', label: 'Clients' },
];

const processSteps = [
    {
        icon: 'search',
        title: 'Discover',
        description: 'We begin by excavating the core narrative, understanding the \'why\' behind the story before the first light is rigged.',
    },
    {
        icon: 'palette',
        iconFill: true,
        title: 'Create',
        description: 'Using anamorphic glass and intentional lighting, we translate concepts into high-fidelity cinematic experiences.',
    },
    {
        icon: 'send',
        title: 'Deliver',
        description: 'Precision editing and bespoke color grading ensure the final piece resonates across all digital touchpoints.',
    },
];

const btsImages = [
    {
        src: 'https://res.cloudinary.com/dtetfimeq/image/upload/v1776459582/afobaino-films/gallery/afobaino-01.jpg',
        alt: 'Film set at night with HMI lights',
    },
    {
        src: 'https://res.cloudinary.com/dtetfimeq/image/upload/v1776459585/afobaino-films/gallery/afobaino-02.jpg',
        alt: 'Film editor using color grading panel',
    },
    {
        src: 'https://res.cloudinary.com/dtetfimeq/image/upload/v1776459590/afobaino-films/gallery/afobaino-03.jpg',
        alt: 'Cinematographer during a sunset beach shoot',
    },
    {
        src: 'https://res.cloudinary.com/dtetfimeq/image/upload/v1776459594/afobaino-films/gallery/afobaino-04.jpg',
        alt: 'Equipment setup with clapperboard and lenses',
    },
];
</script>

<template>
    <div>
        <header class="relative h-[716px] w-full overflow-hidden flex items-center justify-center">
            <div class="absolute inset-0 z-0">
                <img
                    src="https://res.cloudinary.com/dtetfimeq/image/upload/v1776459691/afobaino-films/gallery/afobaino-05.jpg"
                    alt="Film crew in a misty forest at dawn"
                    class="w-full h-full object-cover brightness-50"
                />
                <div class="absolute inset-0 bg-black/30"></div>
            </div>
            <div class="relative z-10 text-center px-4">
                <h1 class="text-5xl md:text-8xl font-headline text-white tracking-tighter italic">The Heart Behind the Lens</h1>
                <p class="mt-6 font-serif text-xl md:text-2xl text-white/70 max-w-2xl mx-auto">Crafting digital narratives that transcend the screen.</p>
            </div>
        </header>

        <section class="bg-surface-dim py-24 md:py-40">
            <div class="max-w-7xl mx-auto px-6 md:px-12 grid grid-cols-1 md:grid-cols-2 gap-16 md:gap-24 items-center">
                <div class="relative aspect-3/4 overflow-hidden bg-surface-dim">
                    <img
                        src="https://images.unsplash.com/photo-1616469829935-c2f33ebd89b8?w=800&q=80&auto=format&fit=crop"
                        alt="Portrait of the filmmaker"
                        class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-1000"
                    />
                </div>
                <div class="space-y-12">
                    <div class="space-y-6">
                        <h2 class="text-primary font-sans uppercase tracking-[0.3em] text-sm">Our Story</h2>
                        <p class="text-3xl md:text-4xl font-serif leading-tight text-on-surface">
                            We believe that every frame should feel like a memory. Our journey began in the pursuit of visual poetry, capturing the raw, unscripted beauty of human connection.
                        </p>
                        <p class="text-on-surface-variant leading-relaxed text-lg">
                            Founded on the principle of the "Digital Auteur," Afobaino Films merges technical precision with emotional depth. We don't just record events; we curate atmospheres.
                        </p>
                    </div>
                    <div class="grid grid-cols-3 gap-8 pt-8 border-t border-outline">
                        <div v-for="stat in stats" :key="stat.label">
                            <div class="text-4xl font-headline text-primary">{{ stat.value }}</div>
                            <div class="text-[10px] uppercase tracking-widest text-on-surface-variant mt-2">{{ stat.label }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-white py-24 md:py-40">
            <div class="max-w-7xl mx-auto px-6 md:px-12">
                <div class="mb-20 text-center">
                    <h2 class="text-on-surface-variant font-sans uppercase tracking-[0.3em] text-xs mb-4">Our Method</h2>
                    <h3 class="text-4xl md:text-6xl font-headline">The Auteur Process</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-px bg-outline/30">
                    <div
                        v-for="step in processSteps"
                        :key="step.title"
                        class="bg-surface-dim p-12 space-y-8 group hover:bg-surface-container transition-colors duration-500"
                    >
                        <div class="w-16 h-16 rounded-full flex items-center justify-center bg-surface-container text-primary group-hover:scale-110 transition-transform">
                            <span
                                class="material-symbols-outlined text-3xl"
                                :style="step.iconFill ? { fontVariationSettings: '\'FILL\' 1' } : {}"
                            >
                                {{ step.icon }}
                            </span>
                        </div>
                        <div class="space-y-4">
                            <h4 class="text-2xl font-serif">{{ step.title }}</h4>
                            <p class="text-on-surface-variant leading-relaxed">{{ step.description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-12 bg-on-surface overflow-hidden">
            <div class="flex overflow-x-auto gap-4 px-4 pb-4 scrollbar-hide" style="-ms-overflow-style: none; scrollbar-width: none;">
                <div
                    v-for="img in btsImages"
                    :key="img.alt"
                    class="flex-none w-[80vw] md:w-[40vw] aspect-video"
                >
                    <img
                        :src="img.src"
                        :alt="img.alt"
                        class="w-full h-full object-cover saturate-50"
                    />
                </div>
            </div>
        </section>

        <section class="py-32 md:py-40 bg-white text-center px-6">
            <div class="max-w-3xl mx-auto space-y-10">
                <h2 class="text-5xl md:text-7xl font-headline tracking-tighter">Ready to Tell Your Story?</h2>
                <p class="text-xl font-serif text-on-surface-variant italic">Let's collaborate on your next masterpiece.</p>
                <div class="pt-6">
                    <Link
                        href="/contact"
                        class="inline-block bg-primary text-white font-sans font-bold uppercase tracking-widest px-12 py-5 rounded-lg hover:shadow-[0_0_20px_rgba(201,168,76,0.4)] transition-all duration-300"
                    >
                        Get in Touch
                    </Link>
                </div>
            </div>
        </section>
    </div>
</template>

<style scoped>
.scrollbar-hide::-webkit-scrollbar {
    display: none;
}
</style>
