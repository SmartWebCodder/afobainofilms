<script setup>
import { ref, computed } from 'vue';

const props = defineProps({
    projects: { type: Array, default: () => [] },
});

const activeFilter = ref('All');
const visibleCount = ref(6);
const activeProject = ref(null);

const fallbackProjects = [
    {
        title: 'Eternal Frames',
        category: 'Weddings',
        description: 'A timeless wedding captured in golden light.',
        aspect: 'aspect-[3/4]',
        cover_image: 'https://res.cloudinary.com/dtetfimeq/image/upload/v1776459582/afobaino-films/gallery/afobaino-01.jpg',
    },
    {
        title: 'Golden Hour',
        category: 'Weddings',
        description: 'Warmth and beauty as the sun sets on a perfect day.',
        aspect: 'aspect-video',
        cover_image: 'https://res.cloudinary.com/dtetfimeq/image/upload/v1776459585/afobaino-films/gallery/afobaino-02.jpg',
    },
    {
        title: 'Sacred Moments',
        category: 'Weddings',
        description: 'Every detail whispers a story of love.',
        aspect: 'aspect-square',
        cover_image: 'https://res.cloudinary.com/dtetfimeq/image/upload/v1776459590/afobaino-films/gallery/afobaino-03.jpg',
    },
    {
        title: 'Timeless Bond',
        category: 'Weddings',
        description: 'Two souls woven together forever.',
        aspect: 'aspect-video',
        cover_image: 'https://res.cloudinary.com/dtetfimeq/image/upload/v1776459594/afobaino-films/gallery/afobaino-04.jpg',
    },
    {
        title: 'Radiant Joy',
        category: 'Weddings',
        description: 'A celebration of love and light.',
        aspect: 'aspect-[3/4]',
        cover_image: 'https://res.cloudinary.com/dtetfimeq/image/upload/v1776459691/afobaino-films/gallery/afobaino-05.jpg',
    },
    {
        title: 'Whispered Vows',
        category: 'Weddings',
        description: 'Intimate promises under open skies.',
        aspect: 'aspect-video',
        cover_image: 'https://res.cloudinary.com/dtetfimeq/image/upload/v1776459695/afobaino-films/gallery/afobaino-06.jpg',
    },
];

const allProjects = computed(() => {
    if (props.projects.length > 0) {
        return props.projects.map(p => ({
            ...p,
            aspect: p.category === 'Weddings' ? 'aspect-[3/4]' : p.category === 'Events' ? 'aspect-video' : 'aspect-square',
        }));
    }
    return fallbackProjects;
});

const filters = computed(() => {
    const cats = [...new Set(allProjects.value.map(p => p.category))];
    return ['All', ...cats];
});

const filteredProjects = computed(() => {
    if (activeFilter.value === 'All') return allProjects.value;
    return allProjects.value.filter(p => p.category === activeFilter.value);
});

const visibleProjects = computed(() => filteredProjects.value.slice(0, visibleCount.value));
const hasMore = computed(() => visibleCount.value < filteredProjects.value.length);

function loadMore() {
    visibleCount.value += 6;
}

function changeFilter(f) {
    activeFilter.value = f;
    visibleCount.value = 6;
}

function extractYouTubeId(url) {
    if (!url) return null;
    const match = url.match(/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/)([^&?/]+)/);
    return match ? match[1] : null;
}

function openProject(project) {
    activeProject.value = project;
    document.body.style.overflow = 'hidden';
}

function closeProject() {
    activeProject.value = null;
    document.body.style.overflow = '';
}
</script>

<template>
    <div>
        <header class="relative h-[512px] flex items-center justify-center overflow-hidden">
            <div class="absolute inset-0 z-0">
                <div class="absolute inset-0 bg-black/60 z-10"></div>
                <img
                    src="https://res.cloudinary.com/dtetfimeq/image/upload/v1776459698/afobaino-films/gallery/afobaino-07.jpg"
                    alt="Portfolio Background"
                    class="w-full h-full object-cover blur-sm scale-105"
                />
            </div>
            <div class="relative z-20 text-center px-6">
                <h1 class="font-headline text-5xl md:text-7xl tracking-widest text-white uppercase mb-12">Our Portfolio</h1>
                <div class="flex flex-wrap justify-center gap-4">
                    <button
                        v-for="filter in filters"
                        :key="filter"
                        class="px-8 py-2 font-sans text-xs tracking-widest uppercase transition-colors duration-300 cursor-pointer"
                        :class="activeFilter === filter
                            ? 'border-b-2 border-primary text-primary bg-black/30 backdrop-blur-sm'
                            : 'border-b border-transparent text-white/70 hover:text-primary'"
                        @click="changeFilter(filter)"
                    >
                        {{ filter }}
                    </button>
                </div>
            </div>
        </header>

        <main class="max-w-[1600px] mx-auto px-6 md:px-12 py-24 md:py-32">
            <div class="columns-1 md:columns-2 lg:columns-3 gap-8">
                <div
                    v-for="project in visibleProjects"
                    :key="project.title"
                    class="break-inside-avoid mb-8 group relative overflow-hidden bg-surface-dim cursor-pointer transition-all duration-700"
                    @click="openProject(project)"
                >
                    <div :class="['relative overflow-hidden', project.aspect || 'aspect-video']">
                        <img
                            :src="project.cover_image"
                            :alt="project.title"
                            class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110"
                        />
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-black/40 transition-colors duration-500"></div>
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <span class="w-20 h-20 rounded-full border-2 border-white/80 text-white flex items-center justify-center backdrop-blur-sm bg-black/30">
                                <span class="material-symbols-outlined text-3xl">play_arrow</span>
                            </span>
                        </div>
                    </div>
                    <div class="p-8 space-y-4">
                        <h3 class="font-headline text-3xl text-on-surface">{{ project.title }}</h3>
                        <p class="font-serif text-lg text-on-surface-variant italic leading-relaxed">{{ project.description }}</p>
                    </div>
                </div>
            </div>

            <div v-if="hasMore" class="flex justify-center mt-24">
                <button
                    @click="loadMore"
                    class="group relative px-12 py-4 border border-primary overflow-hidden transition-all duration-500 hover:bg-primary cursor-pointer"
                >
                    <span class="relative z-10 font-sans text-xs tracking-[0.3em] uppercase text-primary group-hover:text-white transition-colors duration-500">Load More Works</span>
                </button>
            </div>
        </main>
    </div>

    <!-- Project Video Modal -->
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
                v-if="activeProject"
                class="fixed inset-0 z-[70] flex items-center justify-center px-4"
                @click.self="closeProject"
            >
                <div class="absolute inset-0 bg-black/90" @click="closeProject" />

                <div class="relative w-full max-w-5xl z-10">
                    <button
                        @click="closeProject"
                        class="absolute -top-12 right-0 text-white/70 hover:text-white transition-colors cursor-pointer"
                    >
                        <span class="material-symbols-outlined text-3xl">close</span>
                    </button>

                    <!-- YouTube embed if project has youtube_url -->
                    <div v-if="extractYouTubeId(activeProject.youtube_url)" class="aspect-video w-full">
                        <iframe
                            :src="`https://www.youtube.com/embed/${extractYouTubeId(activeProject.youtube_url)}?autoplay=1&rel=0`"
                            class="w-full h-full"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen
                            :title="activeProject.title"
                        ></iframe>
                    </div>

                    <!-- Direct video (MP4) playback -->
                    <div v-else-if="activeProject.video_url" class="aspect-video w-full bg-black">
                        <video
                            :src="activeProject.video_url"
                            :poster="activeProject.cover_image"
                            controls
                            autoplay
                            class="w-full h-full"
                        ></video>
                    </div>

                    <!-- Fallback: show cover image with project details -->
                    <div v-else class="bg-surface-dark">
                        <div class="aspect-video w-full overflow-hidden">
                            <img :src="activeProject.cover_image" :alt="activeProject.title" class="w-full h-full object-cover" />
                        </div>
                        <div class="p-8 text-center">
                            <h3 class="font-headline text-3xl text-white mb-2">{{ activeProject.title }}</h3>
                            <p class="font-serif text-lg text-white/60 italic">{{ activeProject.description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </Transition>
    </Teleport>
</template>
