<script setup>
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const currentYear = new Date().getFullYear();
const page = usePage();

const socials = computed(() => {
    const s = page.props.socials ?? {};
    const list = [];
    if (s.instagram_url) list.push({ name: 'Instagram', href: s.instagram_url, type: 'instagram' });
    if (s.facebook_url) list.push({ name: 'Facebook', href: s.facebook_url, type: 'facebook' });
    if (s.youtube_url) list.push({ name: 'YouTube', href: s.youtube_url, type: 'youtube' });
    return list;
});

const contactEmail = computed(() => page.props.booking?.contact_email || 'hello@afobainofilms.com');
</script>

<template>
    <footer class="bg-surface-dim border-t border-outline/40">
        <div class="max-w-7xl mx-auto px-6 md:px-12 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
                <!-- Left: Text us -->
                <div class="text-center md:text-left">
                    <p class="text-sm text-on-surface-variant mb-3">Text us:</p>
                    <a :href="`mailto:${contactEmail}`" class="text-sm text-on-surface hover:text-primary transition-colors">{{ contactEmail }}</a>
                </div>

                <!-- Center: Copyright -->
                <div class="text-center">
                    <p class="text-sm text-on-surface-variant leading-relaxed">
                        &copy; {{ currentYear }} Afobaino Films &mdash; Ireland Wedding Videographer and Photographer.<br>
                        Ireland, Dublin, Co. Kildare.
                    </p>
                </div>

                <!-- Right: Join us -->
                <div class="text-center md:text-right">
                    <p class="text-sm text-on-surface-variant mb-3">Join us:</p>
                    <div class="flex gap-4 justify-center md:justify-end">
                        <a
                            v-for="social in socials"
                            :key="social.name"
                            :href="social.href"
                            target="_blank"
                            rel="noopener"
                            class="text-on-surface-variant hover:text-primary transition-colors"
                            :aria-label="social.name"
                        >
                            <!-- Instagram -->
                            <svg v-if="social.type === 'instagram'" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.2c3.2 0 3.6 0 4.8.1 1.2.1 1.8.2 2.2.4.6.2 1 .5 1.4.9.4.4.7.8.9 1.4.2.4.4 1 .4 2.2.1 1.2.1 1.6.1 4.8s0 3.6-.1 4.8c-.1 1.2-.2 1.8-.4 2.2-.2.6-.5 1-.9 1.4-.4.4-.8.7-1.4.9-.4.2-1 .4-2.2.4-1.2.1-1.6.1-4.8.1s-3.6 0-4.8-.1c-1.2-.1-1.8-.2-2.2-.4-.6-.2-1-.5-1.4-.9-.4-.4-.7-.8-.9-1.4-.2-.4-.4-1-.4-2.2C2.2 15.6 2.2 15.2 2.2 12s0-3.6.1-4.8c.1-1.2.2-1.8.4-2.2.2-.6.5-1 .9-1.4.4-.4.8-.7 1.4-.9.4-.2 1-.4 2.2-.4C8.4 2.2 8.8 2.2 12 2.2m0-2.2C8.7 0 8.3 0 7.1.1 5.8.1 5 .3 4.2.6c-.8.3-1.5.7-2.2 1.4C1.3 2.7.9 3.4.6 4.2.3 5 .1 5.8.1 7.1 0 8.3 0 8.7 0 12s0 3.7.1 4.9c0 1.3.2 2.1.5 2.9.3.8.7 1.5 1.4 2.2.7.7 1.4 1.1 2.2 1.4.8.3 1.6.5 2.9.5C8.3 24 8.7 24 12 24s3.7 0 4.9-.1c1.3 0 2.1-.2 2.9-.5.8-.3 1.5-.7 2.2-1.4.7-.7 1.1-1.4 1.4-2.2.3-.8.5-1.6.5-2.9.1-1.2.1-1.6.1-4.9s0-3.7-.1-4.9c0-1.3-.2-2.1-.5-2.9-.3-.8-.7-1.5-1.4-2.2C21.3 1.3 20.6.9 19.8.6 19 .3 18.2.1 16.9.1 15.7 0 15.3 0 12 0z"/><path d="M12 5.8c-3.4 0-6.2 2.8-6.2 6.2s2.8 6.2 6.2 6.2 6.2-2.8 6.2-6.2S15.4 5.8 12 5.8zm0 10.2c-2.2 0-4-1.8-4-4s1.8-4 4-4 4 1.8 4 4-1.8 4-4 4z"/><circle cx="18.4" cy="5.6" r="1.4"/></svg>
                            <!-- YouTube -->
                            <svg v-else-if="social.type === 'youtube'" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M23.5 6.2c-.3-1-1.1-1.8-2.1-2.1C19.6 3.6 12 3.6 12 3.6s-7.6 0-9.4.5c-1 .3-1.8 1.1-2.1 2.1C0 8 0 12 0 12s0 4 .5 5.8c.3 1 1.1 1.8 2.1 2.1 1.8.5 9.4.5 9.4.5s7.6 0 9.4-.5c1-.3 1.8-1.1 2.1-2.1.5-1.8.5-5.8.5-5.8s0-4-.5-5.8zM9.6 15.6V8.4l6.3 3.6-6.3 3.6z"/></svg>
                            <!-- Facebook -->
                            <svg v-else-if="social.type === 'facebook'" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.07C24 5.4 18.63 0 12 0S0 5.4 0 12.07C0 18.1 4.39 23.1 10.13 24v-8.44H7.08v-3.49h3.05V9.41c0-3.02 1.79-4.69 4.53-4.69 1.31 0 2.68.24 2.68.24v2.97h-1.51c-1.49 0-1.95.93-1.95 1.89v2.26h3.32l-.53 3.49h-2.79V24C19.61 23.1 24 18.1 24 12.07z"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</template>
