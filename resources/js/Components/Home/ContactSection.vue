<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const form = useForm({
    name: '',
    email: '',
    event_date: '',
    event_venue: '',
    referral_source: '',
    vision: '',
});

const loading = ref(false);
const showModal = ref(false);

function submit() {
    form.post('/contact', {
        preserveScroll: true,
        onSuccess: () => {
            loading.value = true;
            form.reset();
            setTimeout(() => {
                loading.value = false;
                showModal.value = true;
            }, 2000);
        },
    });
}

function closeModal() {
    showModal.value = false;
}
</script>

<template>
    <section class="py-20 md:py-24 px-8 md:px-16 bg-[#ececec]">
        <div class="max-w-[1240px] mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-[1.15fr_0.85fr] gap-10 lg:gap-14 items-start">
                <div class="w-full overflow-hidden bg-[#d9d9d9]">
                    <img
                        src="https://res.cloudinary.com/dtetfimeq/image/upload/v1776459691/afobaino-films/gallery/afobaino-05.jpg"
                        alt="Afobaino Films wedding scene"
                        class="w-full h-full aspect-[4/5] object-cover grayscale"
                    >
                </div>

                <form class="pt-1 space-y-8" @submit.prevent="submit" autocomplete="off">
                    <div class="space-y-2">
                        <p class="font-sans uppercase tracking-[0.24em] text-xs text-on-surface">Wedding Inquiries 2026-27</p>
                        <p class="font-sans text-sm tracking-[0.12em] text-on-surface-variant">Planning a wedding? Let's connect.</p>
                    </div>

                    <div class="space-y-7">
                        <div>
                            <label class="block mb-2 text-[13px] tracking-[0.18em] text-on-surface-variant">Your name(s) *</label>
                            <input
                                v-model="form.name"
                                type="text"
                                autocomplete="off"
                                class="block w-full border-0 border-b border-[#cfcfcf] bg-transparent py-2 px-0 text-on-surface focus:border-[#a8a8a8] focus:ring-0 focus:outline-none outline-none transition-colors"
                            >
                            <p v-if="form.errors.name" class="text-error text-xs mt-1">{{ form.errors.name }}</p>
                        </div>

                        <div>
                            <label class="block mb-2 text-[13px] tracking-[0.18em] text-on-surface-variant">Date of event *</label>
                            <input
                                v-model="form.event_date"
                                type="text"
                                autocomplete="off"
                                class="block w-full border-0 border-b border-[#cfcfcf] bg-transparent py-2 px-0 text-on-surface focus:border-[#a8a8a8] focus:ring-0 focus:outline-none outline-none transition-colors"
                            >
                        </div>

                        <div>
                            <label class="block mb-2 text-[13px] tracking-[0.18em] text-on-surface-variant">Event venue *</label>
                            <input
                                v-model="form.event_venue"
                                type="text"
                                autocomplete="off"
                                class="block w-full border-0 border-b border-[#cfcfcf] bg-transparent py-2 px-0 text-on-surface focus:border-[#a8a8a8] focus:ring-0 focus:outline-none outline-none transition-colors"
                            >
                        </div>

                        <div>
                            <label class="block mb-2 text-[13px] tracking-[0.18em] text-on-surface-variant">How did you find us? *</label>
                            <input
                                v-model="form.referral_source"
                                type="text"
                                autocomplete="off"
                                class="block w-full border-0 border-b border-[#cfcfcf] bg-transparent py-2 px-0 text-on-surface focus:border-[#a8a8a8] focus:ring-0 focus:outline-none outline-none transition-colors"
                            >
                        </div>

                        <div>
                            <label class="block mb-2 text-[13px] tracking-[0.18em] text-on-surface-variant">Email *</label>
                            <input
                                v-model="form.email"
                                type="email"
                                autocomplete="off"
                                class="block w-full border-0 border-b border-[#cfcfcf] bg-transparent py-2 px-0 text-on-surface focus:border-[#a8a8a8] focus:ring-0 focus:outline-none outline-none transition-colors"
                            >
                            <p v-if="form.errors.email" class="text-error text-xs mt-1">{{ form.errors.email }}</p>
                        </div>

                        <div>
                            <label class="block mb-2 text-[13px] tracking-[0.18em] text-on-surface-variant">Add a message *</label>
                            <textarea
                                v-model="form.vision"
                                rows="3"
                                autocomplete="off"
                                class="block w-full border-0 border-b border-[#cfcfcf] bg-transparent py-2 px-0 text-on-surface focus:border-[#a8a8a8] focus:ring-0 focus:outline-none outline-none transition-colors resize-none"
                            ></textarea>
                        </div>
                    </div>

                    <button
                        type="submit"
                        :disabled="form.processing || loading"
                        class="w-full sm:w-auto min-w-[220px] px-10 py-3 rounded-full border border-[#d0d0d0] bg-[#dfdfdf] text-on-surface text-[11px] font-sans tracking-[0.16em] uppercase hover:bg-[#d6d6d6] transition-colors disabled:opacity-50 flex items-center justify-center gap-2"
                    >
                        <svg v-if="form.processing || loading" class="animate-spin h-4 w-4 text-on-surface" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                        </svg>
                        {{ form.processing || loading ? 'Sending...' : 'Send a message' }}
                    </button>
                </form>
            </div>
        </div>

        <!-- Success Modal -->
        <Teleport to="body">
            <Transition name="modal">
                <div v-if="showModal" class="fixed inset-0 z-[9999] flex items-center justify-center p-6" @click.self="closeModal">
                    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>
                    <div class="relative bg-white max-w-md w-full p-12 text-center space-y-6 shadow-2xl">
                        <div class="mx-auto w-20 h-20 rounded-full bg-primary/10 flex items-center justify-center">
                            <span class="material-symbols-outlined text-primary text-4xl" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                        </div>
                        <h3 class="text-3xl font-headline italic text-on-surface">Message Sent</h3>
                        <p class="text-on-surface-variant leading-relaxed">Thank you for reaching out. We'll be in touch within 24 hours to discuss your vision.</p>
                        <button
                            @click="closeModal"
                            class="mt-4 px-10 py-3 bg-primary text-white font-sans font-bold uppercase tracking-widest text-xs hover:bg-primary-dark transition-all duration-300"
                        >
                            Close
                        </button>
                    </div>
                </div>
            </Transition>
        </Teleport>
    </section>
</template>

<style scoped>
.modal-enter-active,
.modal-leave-active {
    transition: opacity 0.3s ease;
}
.modal-enter-active .relative,
.modal-leave-active .relative {
    transition: transform 0.3s ease, opacity 0.3s ease;
}
.modal-enter-from,
.modal-leave-to {
    opacity: 0;
}
.modal-enter-from .relative,
.modal-leave-to .relative {
    transform: scale(0.95) translateY(10px);
    opacity: 0;
}
</style>