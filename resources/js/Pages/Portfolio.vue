<script setup>
import { ref, computed } from 'vue';

const props = defineProps({
    projects: { type: Array, default: () => [] },
});

const activeFilter = ref('All');

const fallbackProjects = [
    {
        title: 'The Tuscane Vow',
        category: 'Weddings',
        location: 'Italy',
        description: 'A narrative of silence and golden hills.',
        duration: '04:20',
        aspect: 'aspect-[3/4]',
        cover_image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuBkK9acq3TjmrM32BAClBbtb-rzHc5SDwjLQvGhaJ72EctUftBqGH_g86xT7Xb6yklEjxCVY1YM_JosBi3HWoQ0gPHSLNutXqKkt6fHhu0vHxLRlCr-CWxSqsBvMxuSPT22SyOJaKkMqzKNitovg1zatPSw-kLOWR6Qkb3fN2Ru5YUqLkTiZNywLUd2qkOu7cIX-W3pmE1bfi-6yaKTMTqAEDOo7-HmT7N0i856tdUVvWGeQ2kzlDizItBvIK-_BKbeOVobmoDk0ls',
    },
    {
        title: 'Nocturnal Rhythms',
        category: 'Events',
        location: 'London',
        description: 'Capturing the pulse of the underground scene.',
        duration: '12:45',
        aspect: 'aspect-video',
        cover_image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuCKQ3OZGtdwwivv4senwdy7Yj11frXnH0moo9m9kxX1pz7UhVKRrHVkZ6WxjJVFfzsig2c3ufleBXgdOyJ7UWFjEC2tLZGclIIxRl_rvsrEgwMoUezcpWeYfjvOci33cLIV5uSHRa_GhstQF3bDQFJX0CF0zgix4kJaIcxPChVQ8szeAmW0uG8QLOgup7MHxLb4XA5gbAxbFgTdx3c_sMlV08IeGe-V6iyEdlFK6X-r2R2abJdgGD_ahjvvF_PtiCymMViyTnsQQZA',
    },
    {
        title: 'Concrete Monoliths',
        category: 'Commercial',
        location: 'NYC',
        description: 'A geometric study of urban solitude.',
        duration: '01:30',
        aspect: 'aspect-square',
        cover_image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuCRfRS_C9yVOgsw27CrMlrWsJQGgPD7FnU7ggoAI_7hPGNsRYhRjzCjv8U-a6xxmAKUD-omOoBoj7nfi9Zdk6cXYV-STGmNIsOAq-htitSBEW-v1bIe_JEJgsNXRXPE-lLT8hvvrwepIuK6SxXQcGSdMms8rFSfo5Gas3v1e2knO2oRQ-iVEKoyd2S2K3nAJLqaA3iDj-7dPEL8y_r3Xl9lZgojIcwFW0w6S_bPWDEpW1PdbxechxayOnPyRwmbxbOEidYUrYYboug',
    },
    {
        title: 'Elegance in Rain',
        category: 'Editorial',
        location: 'Paris',
        description: 'Melancholy through a Parisian lens.',
        duration: '02:15',
        aspect: 'aspect-video',
        cover_image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuC9EH-a27hqzFDT0Ti_pR0m-v71IA3CnnhovQWfjwkKn6MW7z074DeCIHlS2p7rdq7RWdjWyQLeDM4tB38VV6UGT2mDkJxHeECznkhlxoQQn_0BRn1rbHj6yERtZBlLdeJrXNs1b8pxrbkPaA8IqWCvSE85tkNaDfft76QiUXz3U4odInW6NewqNnOHhPCXgBdvC9t1CeBsljtltMIGrSkpjCSREhZACZii8jKV6CDmnmC2xUQDasWTzH3qkKyAJ7gjgt9E-KdTFtQ',
    },
    {
        title: 'Vinyl Echoes',
        category: 'Editorial',
        location: 'Berlin',
        description: 'The analog soul of a digital age.',
        duration: '08:00',
        aspect: 'aspect-[3/4]',
        cover_image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuCxma1Dl6JgO7fymAxrpOOOAxlAL-F95I30yIWC3jvUERcKVeo5w4botTwFT9ysp05EjcnALWDrzydMdJO4EAfw_G6Nvgb4vK3qkrqikitJyB7CORwcbshLIlVY4iYlkYO8rk5KeZQjqr4G-LlzIJz0E5m0nivVYcZkxQ9Y1nSB8cMvoRhzH8vXvL7TZ_deEyGahOqqVmzJ1oZ2t89kYeZ4aVoP-tnLDtbpCo_7-hRLgLf1FwXDfmt8Lc30w3eiMadsbs2g23v3-2g',
    },
    {
        title: 'Peak Solitude',
        category: 'Commercial',
        location: 'Swiss Alps',
        description: 'Where the earth meets the ether.',
        duration: '03:45',
        aspect: 'aspect-video',
        cover_image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuDSjWZ6WWsOqqjcZ8YVa5fBDvXNo7J9dLb09kT80sqOoT3AXo14nHOdvWdk3xNGsLtXG5-FuCRmQYFwfdf-xHGTGYznSXaeurVcMCandRET05GmnJoJAzaUpQzCy8EeAsCrEO6OIfcp7t0K6NW4N1hGSMVb5ttcI-sdsrxezbfrS1QXK9n_KSb7WcZ0Wysz_0jHhtQqS5sO1LB9P7Gx7ZG9RCp2qvsKAnTnivxF2NntLm9sQISHW3Bstz3zSjujAtHUskTwHJZiubY',
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
</script>

<template>
    <div>
        <header class="relative h-[512px] flex items-center justify-center overflow-hidden">
            <div class="absolute inset-0 z-0">
                <div class="absolute inset-0 bg-black/60 z-10"></div>
                <img
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuD-ZmMrA1zENdj3Xpq6G-BZXwDIiaEJaYg1RNVaFV1S_oIbyYusHg93Io4lbZlTNrREvA4pSQnr6dm823pL5Z8n-lyI-qRUrj0BscNOmHJsQbZLdaxhCNvg4Sh_3GFQ9p8mC6e-KAq1hxAkDHwSjUYkDMsJrDh9R6MskGMpxDOFcE54gIK8k2s9R3FGnGKb4kw4lwNHQZrI5Xe8XHtgVxQ5SQH9GQqoT09uJrLCOh2oCFCOEvcNV_qVytfRJwmvcmmi4mxSZIv54jA"
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
                        class="px-8 py-2 font-sans text-xs tracking-widest uppercase transition-colors duration-300"
                        :class="activeFilter === filter
                            ? 'border-b-2 border-primary text-primary bg-black/30 backdrop-blur-sm'
                            : 'border-b border-transparent text-white/70 hover:text-primary'"
                        @click="activeFilter = filter"
                    >
                        {{ filter }}
                    </button>
                </div>
            </div>
        </header>

        <main class="max-w-[1600px] mx-auto px-6 md:px-12 py-24 md:py-32">
            <div class="columns-1 md:columns-2 lg:columns-3 gap-8">
                <div
                    v-for="project in filteredProjects"
                    :key="project.title"
                    class="break-inside-avoid mb-8 group relative overflow-hidden bg-surface-dim cursor-pointer transition-all duration-700"
                >
                    <div :class="['relative overflow-hidden', project.aspect || 'aspect-video']">
                        <img
                            :src="project.cover_image"
                            :alt="project.title"
                            class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110"
                        />
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-black/40 transition-colors duration-500"></div>
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <span class="w-24 h-24 rounded-full bg-primary/90 text-white flex items-center justify-center font-sans text-xs font-bold tracking-[0.2em]">VIEW</span>
                        </div>
                    </div>
                    <div class="p-8 space-y-4">
                        <h3 class="font-headline text-3xl text-on-surface">{{ project.title }}</h3>
                        <p class="font-serif text-lg text-on-surface-variant italic leading-relaxed">{{ project.description }}</p>
                    </div>
                </div>
            </div>

            <div class="flex justify-center mt-24">
                <button class="group relative px-12 py-4 border border-primary overflow-hidden transition-all duration-500 hover:bg-primary">
                    <span class="relative z-10 font-sans text-xs tracking-[0.3em] uppercase text-primary group-hover:text-white transition-colors duration-500">Load More Works</span>
                </button>
            </div>
        </main>
    </div>
</template>
