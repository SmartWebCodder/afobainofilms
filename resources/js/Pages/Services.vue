<script setup>
import { Link } from '@inertiajs/vue3';

const services = [
    {
        number: '01',
        label: 'Motion',
        title: 'Wedding Cinematography',
        description: 'Capturing the unseen rhythms of your union. We focus on the quiet glances, the atmospheric tension, and the raw emotion that defines your legacy.',
        price: 'From $4,500',
        image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuAGNWWYhKbfbA4ZCPyttDP_tNo-XF9LnwzprTIo_eiZiNuvjgzPR-4e-NMPoZ-GBFGi0-0_Wlx7fMhIaqwDCxPV7z-f_NH2eiogEU_HDupVe21D8V8L9HKtQ39DjmBWG2dreFIRmQymi0YDXAFtdfXZkY1QbQA3pLFePBbBtzZPfQQOjv4bJZZTXejuOEfc2WPNAez2KwmGM8EYJMG7svWymCfk3EzEiW1T_g31xxbNPqCiHB3tFZxYe6s6ZP95lFxQNT6aRQJwMBo',
        alt: 'Bridal veil in the wind with vintage film grain',
        imgClass: 'grayscale-[0.2]',
    },
    {
        number: '02',
        label: 'Stills',
        title: 'Editorial Photography',
        description: 'High-contrast, archival-grade imagery. Our photography service treats every frame as a standalone piece of art, blending fashion editorial aesthetics with documentary truth.',
        price: 'From $3,000',
        image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuDYAJuFIpXvCskAI9XHLj-kt9ifRSPRNAIXDWWxy-6zKvVt-MeIVzkvRH8ePYWcm3yp1u3FVcCkVQeeng8jmMICf8Nh4W6WG3WMxEBUXJzFzRNIzf4Hr1TY3p-NKga8n2AZtcA2Hxtn5wYBpGFb9k82MaZo4r1V2hbGOl_MI0Q-meOmy94-2WjPwb3FUB44HHf8jyTP4LQE1SrnSphskOQ-XZo3jSnK4uZZsCtEioxQGm2PuWuAcH_iVksibhoSFK5lQwjunFH60uM',
        alt: 'Portrait in a vintage tuxedo',
        imgClass: 'grayscale',
        flipped: true,
    },
    {
        number: '03',
        label: 'Narrative',
        title: 'Creative Brand Films',
        description: 'Conceptual visual storytelling for the modern auteur. We translate brand identities into immersive cinematic experiences that resonate beyond the screen.',
        price: 'Custom Quote',
        image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuAkVL3PlvHK_AxAEXUKhHqj1ViYZ80bb7IXmJuuUNk2waAxvVYhA8dNcxNLzCDQO1zyhFSu79hWmotBwnw-nMMSbCQPRXvtD4htGnlK89gYNawCeCsXFc0-Ph6sX-kGw67o3l-cMYU2osCB_yKKZrpJPP81HMFdmCrxSuA51aByM37jWoTTUJ3YTvQt3BsavjhmMJ9uVYADidbZw_2d2HxcTQBZBW_yTU8tCCqL_0Kn1AQQFdXp3STVmZEnPYysyAKWk438eFOJNOQ',
        alt: 'Light reflecting off water during blue hour',
        imgClass: '',
    },
];

const steps = [
    { number: '01', title: 'Consultation', description: 'A deep dive into your vision, moodboards, and the emotional core of your event.' },
    { number: '02', title: 'Planning', description: 'Technical scouting, storyboard refinement, and lighting logistics coordination.' },
    { number: '03', title: 'Production', description: 'Unobtrusive, cinematic capture using industry-grade anamorphic lenses.' },
    { number: '04', title: 'Delivery', description: 'The final masterpiece, color-graded and sound-mixed to perfection.' },
];
</script>

<template>
    <div>
        <header class="relative h-[512px] w-full overflow-hidden flex items-center justify-center">
            <div class="absolute inset-0 z-0">
                <img
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuBM1oVHxPD-Tq5DjJflFMK081lRCyaxioJqyTAXOMWNj_1nyWdQ62VVLY0w_xwEubIau2sgCYCTk-j9Iruf0QnPJzU4NeTAj42CcwHJGPqaH-Le8ACmBXAboCJbdWKZzEztOjvG0LoSDKkwOc_gmnX-hzVXgPhFVUdu-1QFWK_bdJpBV_ynMCht6-cyrwTnFs7vikbPr8VhueTtbqr7Kk1tuqo8vWzk9X_cgjilS1SKjKf8vtZvCSSq90AEHwx8hvKMllyTBeGgQ10"
                    alt="Dramatic couple in a golden field"
                    class="w-full h-full object-cover brightness-50"
                />
            </div>
            <div class="relative z-10 text-center px-4">
                <span class="font-sans uppercase tracking-[0.3em] text-primary text-xs mb-4 block">Our Services</span>
                <h1 class="font-headline text-5xl md:text-7xl italic text-white leading-tight">Crafting Visual Stories</h1>
            </div>
        </header>

        <main class="py-24">
            <section class="max-w-7xl mx-auto space-y-32 md:space-y-40 px-6">
                <div
                    v-for="service in services"
                    :key="service.number"
                    class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center"
                >
                    <div
                        :class="service.flipped ? 'order-2 md:order-1 space-y-8 md:pr-12' : 'space-y-8 md:pl-12'"
                        :style="service.flipped ? {} : { order: 2 }"
                    >
                        <span class="font-sans text-xs uppercase tracking-widest text-primary/60">{{ service.number }} / {{ service.label }}</span>
                        <h2 class="font-headline text-4xl md:text-5xl text-on-surface">{{ service.title }}</h2>
                        <p class="font-serif text-xl text-on-surface-variant italic leading-relaxed">{{ service.description }}</p>
                        <div class="flex items-center gap-4">
                            <span class="font-sans text-lg font-bold text-primary">{{ service.price }}</span>
                            <div class="h-px w-12 bg-outline"></div>
                            <Link href="/contact" class="font-sans uppercase tracking-widest text-xs hover:text-primary transition-colors">Inquire</Link>
                        </div>
                    </div>
                    <div
                        class="aspect-4/5 overflow-hidden"
                        :class="service.flipped ? 'order-1 md:order-2' : ''"
                        :style="service.flipped ? {} : { order: 1 }"
                    >
                        <img
                            :src="service.image"
                            :alt="service.alt"
                            :class="['w-full h-full object-cover hover:scale-105 transition-transform duration-1000', service.imgClass]"
                        />
                    </div>
                </div>
            </section>



            <section class="py-32 md:py-40 max-w-7xl mx-auto px-6">
                <div class="mb-20">
                    <h2 class="font-headline text-4xl md:text-5xl italic">The Creative Journey</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                    <div v-for="step in steps" :key="step.number" class="space-y-6">
                        <div class="font-headline text-2xl text-primary italic">{{ step.number }}.</div>
                        <h4 class="font-sans uppercase tracking-widest text-sm font-bold">{{ step.title }}</h4>
                        <p class="text-sm text-on-surface-variant leading-relaxed">{{ step.description }}</p>
                    </div>
                </div>
            </section>
        </main>
    </div>
</template>
