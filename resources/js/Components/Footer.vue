<script setup>
import { Link } from '@inertiajs/vue3';

const currentYear = new Date().getFullYear();

const quickLinks = [
    { name: 'Portfolio', href: '/portfolio' },
    { name: 'Services', href: '/services' },
    { name: 'About', href: '/about' },
    { name: 'Contact', href: '/contact' },
];

const socials = [
    { name: 'Instagram', href: '#', icon: 'photo_camera' },
    { name: 'YouTube', href: '#', icon: 'smart_display' },
    { name: 'TikTok', href: '#', icon: 'music_note' },
];
</script>

<template>
    <footer class="bg-surface-dark text-white/60">
        <div class="max-w-7xl mx-auto px-6 md:px-12 py-16">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <!-- Brand -->
                <div class="space-y-4">
                    <div class="text-xl font-headline text-primary tracking-tight font-bold">
                        AFOBAINO FILMS
                    </div>
                    <p class="text-xs uppercase tracking-[0.15em] leading-relaxed">
                        Premium cinematography &amp; photography.<br>
                        Capturing stories that move.
                    </p>
                </div>

                <!-- Quick links -->
                <div class="flex flex-col gap-3">
                    <Link
                        v-for="link in quickLinks"
                        :key="link.name"
                        :href="link.href"
                        class="text-xs uppercase tracking-[0.15em] hover:text-primary transition-colors duration-300"
                    >
                        {{ link.name }}
                    </Link>
                </div>

                <!-- Social + contact -->
                <div class="space-y-4">
                    <div class="flex gap-4">
                        <a
                            v-for="social in socials"
                            :key="social.name"
                            :href="social.href"
                            target="_blank"
                            rel="noopener"
                            class="w-10 h-10 border border-white/20 flex items-center justify-center hover:border-primary hover:text-primary transition-colors duration-300"
                            :aria-label="social.name"
                        >
                            <span class="material-symbols-outlined text-lg">{{ social.icon }}</span>
                        </a>
                    </div>
                    <a
                        href="mailto:hello@afobainofilms.com"
                        class="text-xs uppercase tracking-[0.15em] hover:text-primary transition-colors"
                    >
                        hello@afobainofilms.com
                    </a>
                </div>
            </div>

            <div class="mt-12 pt-8 border-t border-white/10 text-center">
                <p class="text-[10px] uppercase tracking-[0.2em]">
                    &copy; {{ currentYear }} Afobaino Films. All rights reserved.
                </p>
            </div>
        </div>
    </footer>
</template>
