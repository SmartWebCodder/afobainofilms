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
        src: 'https://lh3.googleusercontent.com/aida-public/AB6AXuBuOFbyRxiAuFs2X_oVZbWr6a-gsUlRNfxcbffkN2zrYTHy0m_gMfFjaWsqW8BQUvlCzLbLMaTGfZQudts5eFAVXSgNOZupDqtH7RQNX1Ujnuq87LBEAWWFxR3Qo1OJNrhVl6mKCIkXJczJu-uXAaq6otUqdRH9dYrXFrnHhXGyWWhCS0x1rcgrH8OATnmFzuKZBgrdCCUZiNLJA1U30BTvGf73_UwfjIFL5IJjjA0cwtZQmWzxt4-u_CBkaw2xGxwlmQheaMTiWzM',
        alt: 'Film set at night with HMI lights',
    },
    {
        src: 'https://lh3.googleusercontent.com/aida-public/AB6AXuCiavpD3c0GDSzCR5C2yttlmV8Orxy59IYpwKjYGT8XiQwp51uDCwRovb-J6tFBa6-4Xp6sz5XbRvhZt-rrntrjrBmisWMNG5JgKftj1LBUmGun-xroIYShcO6ZEUZo_P3TwYHr8QVlEEL4s7AwLllmwXrgmXmm0FIow7tM5vJQ-PPC6itZqez-u0ACBtnUSdSAh0fifQigTF7rn2zgnLDzNq201QtBkAAY_feIKM5Aow_94NKuzXnu9aBKzK_P7R4nvLBdsyYvzA0',
        alt: 'Film editor using color grading panel',
    },
    {
        src: 'https://lh3.googleusercontent.com/aida-public/AB6AXuBFkTkltQcubJ-tj54bYvuzKmDO1bLz11Cc3eV8zsu6IKj-SFT8GDGiWebRTF7XC0b3Wq-qwQotIidLWOBtvi004lvb42OqEVfMcoTN-NBs-hiFsbIsPQeCR-2ZoWJjMEDylNLrsmD1v5nJjqjCKNxx1X8IS3mTAXfJavcTEGCkV9IwbNk12_KdXoF6PrImNmdDoBO_J7neCoWjqRbHnTosrRm6Ni5g1oAv0ggLRnLUKdARhXqJ9pb2bk1YUywPTwoQYfLwb3s6GeU',
        alt: 'Cinematographer during a sunset beach shoot',
    },
    {
        src: 'https://lh3.googleusercontent.com/aida-public/AB6AXuCh6K9HDuxs2-1kY0twYWH4XswK0_CNM6hH4sTTEA7IpjoRDxNRn1VAzXcNb1VZSVwu2JRqiKFCSOw6_b9ml_GnJ1DoTbOs5UVngakKv3DfdU4pEzbokTf5ozWRf_B6or7QC7epOJWCs6Wtm-iGjo5eTMkITgMd2vgIZKFDSyB-NYzt0gt-8x4-qJjCtSE5WeTC0JHpgSypLTLifMKy5hjk1wWd1y2YUvwSZyhshdulGtdQZdNltqKuzKaQG8PacnJALFbUi3toJAs',
        alt: 'Equipment setup with clapperboard and lenses',
    },
];
</script>

<template>
    <div>
        <header class="relative h-[716px] w-full overflow-hidden flex items-center justify-center">
            <div class="absolute inset-0 z-0">
                <img
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuCgBiGYbY9UThXj-RjGs_YJPpatuLyGEHPCi9zndK4t1OsxTmu4J5HW1RFOq1YA7DUcSOt-2fLawE095rjNycXeJ3BtSgbB30aiM6cYDEfktg1PiwLgR0a4Qsw7Jo6bFa4pqCdTgEv8jJZlBR4G-C9bPVZq5KBt_EEPijJBmegNG1Ix3-4Kx3Xt79WCLypzMSKpqoMmfydGwEQesuaxVGRCmon4Wk5sW9Wa9Le8jyFx7BzJhWW20uLyP5K6rTkV-758bWBjoK4UZXk"
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
                <div class="relative aspect-3/4 overflow-hidden">
                    <img
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuClgO7na67BRlfw2kCyra3-3zyYHamEMwDA80rmXasRs1BuEi9tUW0HobLC_6eWfZBk5sOj7M76g3a3sMHmhfYB-wV5tc5oO4LKkvHFd1vHaO69XnmJVm1OmwZfk0cLrI02w_gpd9JxudckTaUUPBFqYOwMSVM5QQ5DhkkcNjF3A6HePeiraJ2V1HSNkksqAdmxR5h5-QWBy-vb9Ow9gzA7wyDucqHqV6lsf7d-vtF33Nl89Efo4CayjvoPJxkEA-nAM95W9q5tZ98"
                        alt="Portrait of a film director"
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
