<script setup>
import { ref } from 'vue';

const showVideo = ref(false);
const videoId = 'EWGTUig0eII';
const startTime = 75;

function openVideo() {
    showVideo.value = true;
    document.body.style.overflow = 'hidden';
}

function closeVideo() {
    showVideo.value = false;
    document.body.style.overflow = '';
}
</script>

<template>
    <section id="featured-reel" class="py-24 md:py-32 px-6 md:px-12 bg-white">
        <div class="max-w-7xl mx-auto">
            <div
                class="relative aspect-video w-full bg-surface-dim mb-12 group cursor-pointer overflow-hidden"
                @click="openVideo"
            >
                <img
                    :src="`https://img.youtube.com/vi/${videoId}/maxresdefault.jpg`"
                    alt="Lucretia & David — A Wedding Film by Afobaino Films"
                    class="w-full h-full object-cover opacity-90 group-hover:scale-105 transition-transform duration-1000"
                />
                <div class="absolute inset-0 bg-black/20 group-hover:bg-black/30 transition-colors duration-500"></div>
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="w-24 h-24 rounded-full border border-primary/50 flex items-center justify-center bg-black/20 backdrop-blur-sm group-hover:scale-110 transition-transform duration-500">
                        <span class="material-symbols-outlined text-primary text-5xl">play_arrow</span>
                    </div>
                </div>
            </div>

            <div class="flex flex-col md:flex-row md:items-end justify-between border-l-2 border-primary/20 pl-8">
                <div>
                    <h2 class="font-headline text-3xl md:text-5xl text-on-surface mb-2 font-medium">Lucretia &amp; David</h2>
                    <p class="font-serif italic text-primary/80 text-xl tracking-wide">A Wedding Film by Afobaino Films</p>
                </div>
                <div class="mt-6 md:mt-0 max-w-md">
                    <p class="text-on-surface-variant font-light leading-relaxed">
                        An intimate celebration of love captured through cinematic storytelling.
                        Every glance, every whisper, preserved as a timeless visual narrative.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- YouTube Video Modal -->
    <Teleport to="body">
        <Transition
            enter-active-class="transition duration-300"
            enter-from-class="opacity-0"
            enter-to-class="opacity-100"
            leave-active-class="transition duration-200"
            leave-from-class="opacity-100"
            leave-to-class="opacity-0"
        >
            <div
                v-if="showVideo"
                class="fixed inset-0 z-[70] flex items-center justify-center px-4"
                @click.self="closeVideo"
            >
                <div class="absolute inset-0 bg-black/90" @click="closeVideo" />

                <div class="relative w-full max-w-5xl z-10">
                    <button
                        @click="closeVideo"
                        class="absolute -top-12 right-0 text-white/70 hover:text-white transition-colors"
                    >
                        <span class="material-symbols-outlined text-3xl">close</span>
                    </button>
                    <div class="aspect-video w-full">
                        <iframe
                            :src="`https://www.youtube.com/embed/${videoId}?autoplay=1&start=${startTime}&rel=0`"
                            class="w-full h-full"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen
                            title="Lucretia & David — Afobaino Films"
                        ></iframe>
                    </div>
                </div>
            </div>
        </Transition>
    </Teleport>
</template>
