<script setup>
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

defineProps({
    open: { type: Boolean, default: false },
});

const emit = defineEmits(['close']);

const booking = computed(() => usePage().props.booking ?? {});

const whatsappLink = computed(() => {
    const num = booking.value.whatsapp_number?.replace(/\D/g, '');
    return num ? `https://wa.me/${num}` : null;
});

const phoneLink = computed(() => {
    const num = booking.value.phone_number?.replace(/\D/g, '');
    return num ? `tel:${num}` : null;
});

const emailLink = computed(() => {
    const email = booking.value.contact_email;
    return email ? `mailto:${email}` : null;
});
</script>

<template>
    <Teleport to="body">
        <Transition
            enter-active-class="transition duration-300"
            enter-from-class="opacity-0"
            enter-to-class="opacity-100"
            leave-active-class="transition duration-200"
            leave-from-class="opacity-100"
            leave-to-class="opacity-0"
        >
            <div v-if="open" class="fixed inset-0 z-[60] flex items-center justify-center px-4" @click.self="emit('close')">
                <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" />

                <div class="relative bg-white w-full max-w-sm p-8 space-y-6 shadow-xl">
                    <button @click="emit('close')" class="absolute top-4 right-4 text-on-surface-muted hover:text-on-surface transition-colors">
                        <span class="material-symbols-outlined">close</span>
                    </button>

                    <div class="text-center space-y-2">
                        <h3 class="text-2xl font-headline italic text-on-surface">Let's Connect</h3>
                        <p class="text-sm text-on-surface-variant">Choose your preferred way to reach us</p>
                    </div>

                    <div class="space-y-4">
                        <a
                            v-if="whatsappLink"
                            :href="whatsappLink"
                            target="_blank"
                            class="flex items-center gap-4 p-4 border border-outline hover:border-whatsapp/40 hover:bg-whatsapp/5 transition-colors group"
                        >
                            <span class="material-symbols-outlined text-whatsapp text-2xl">chat</span>
                            <div class="flex-1">
                                <p class="text-xs font-sans uppercase tracking-widest text-on-surface-variant">WhatsApp</p>
                                <p class="text-sm font-medium text-on-surface">{{ booking.whatsapp_number }}</p>
                            </div>
                            <span class="material-symbols-outlined text-on-surface-muted group-hover:text-whatsapp text-sm transition-colors">arrow_forward</span>
                        </a>

                        <a
                            v-if="phoneLink"
                            :href="phoneLink"
                            class="flex items-center gap-4 p-4 border border-outline hover:border-primary/40 hover:bg-primary/5 transition-colors group"
                        >
                            <span class="material-symbols-outlined text-primary text-2xl">call</span>
                            <div class="flex-1">
                                <p class="text-xs font-sans uppercase tracking-widest text-on-surface-variant">Phone</p>
                                <p class="text-sm font-medium text-on-surface">{{ booking.phone_number }}</p>
                            </div>
                            <span class="material-symbols-outlined text-on-surface-muted group-hover:text-primary text-sm transition-colors">arrow_forward</span>
                        </a>

                        <a
                            v-if="emailLink"
                            :href="emailLink"
                            class="flex items-center gap-4 p-4 border border-outline hover:border-primary/40 hover:bg-primary/5 transition-colors group"
                        >
                            <span class="material-symbols-outlined text-primary text-2xl">mail</span>
                            <div class="flex-1">
                                <p class="text-xs font-sans uppercase tracking-widest text-on-surface-variant">Email</p>
                                <p class="text-sm font-medium text-on-surface">{{ booking.contact_email }}</p>
                            </div>
                            <span class="material-symbols-outlined text-on-surface-muted group-hover:text-primary text-sm transition-colors">arrow_forward</span>
                        </a>
                    </div>

                    <p v-if="!whatsappLink && !phoneLink && !emailLink" class="text-center text-sm text-on-surface-muted py-4">
                        Contact details coming soon.
                    </p>
                </div>
            </div>
        </Transition>
    </Teleport>
</template>
