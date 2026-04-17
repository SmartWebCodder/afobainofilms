<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const currentYear = new Date().getFullYear();

const quickLinks = [
    { name: 'Portfolio', href: '/portfolio' },
    { name: 'Services', href: '/services' },
    { name: 'About', href: '/about' },
    { name: 'Contact', href: '/contact' },
];

const page = usePage();
const socials = computed(() => {
    const s = page.props.socials ?? {};
    const list = [];
    if (s.instagram_url) list.push({ name: 'Instagram', href: s.instagram_url, icon: 'photo_camera' });
    if (s.youtube_url) list.push({ name: 'YouTube', href: s.youtube_url, icon: 'smart_display' });
    if (s.tiktok_url) list.push({ name: 'TikTok', href: s.tiktok_url, icon: 'music_note' });
    if (s.facebook_url) list.push({ name: 'Facebook', href: s.facebook_url, icon: 'group' });
    return list;
});

const contactEmail = computed(() => page.props.booking?.contact_email || 'hello@afobainofilms.com');
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
                        :href="`mailto:${contactEmail}`"
                        class="text-xs uppercase tracking-[0.15em] hover:text-primary transition-colors"
                    >
                        {{ contactEmail }}
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
