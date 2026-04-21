<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const form = useForm({
    name: '',
    email: '',
    phone: '',
    event_date: '',
    event_type: '',
    vision: '',
});

const loading = ref(false);
const showModal = ref(false);

function submitForm() {
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
    <div>
        <header class="relative h-102.25 flex items-center justify-center overflow-hidden">
            <img
                src="https://res.cloudinary.com/dtetfimeq/image/upload/v1776459695/afobaino-films/gallery/afobaino-06.jpg"
                alt="Cinematic camera setup"
                class="absolute inset-0 w-full h-full object-cover"
            />
            <div class="absolute inset-0 bg-black/50"></div>
            <div class="relative z-10 text-center px-6">
                <h1 class="text-4xl md:text-6xl font-headline italic tracking-tight text-white">Start Your Story With Us</h1>
                <div class="mt-4 flex justify-center">
                    <div class="w-12 h-px bg-primary/40"></div>
                </div>
            </div>
        </header>

        <main class="max-w-7xl mx-auto px-6 md:px-12 py-24 md:py-32">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-24 items-start">
                <section class="space-y-16">
                    <div class="space-y-4">
                        <span class="font-sans text-xs uppercase tracking-[0.3em] text-primary">Inquiry Form</span>
                        <h2 class="text-3xl font-headline text-on-surface">The Canvas Awaits</h2>
                    </div>

                    <form class="space-y-12" @submit.prevent="submitForm" autocomplete="off">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-12">
                            <div class="relative">
                                <input
                                    id="name"
                                    v-model="form.name"
                                    type="text"
                                    placeholder="Full Name"
                                    autocomplete="off"
                                    class="block w-full border-0 border-b border-outline bg-transparent py-3 px-0 text-on-surface focus:border-primary focus:ring-0 focus:outline-none outline-none transition-colors"
                                />
                            </div>
                            <div class="relative">
                                <input
                                    id="email"
                                    v-model="form.email"
                                    type="email"
                                    placeholder="Email Address"
                                    autocomplete="off"
                                    class="block w-full border-0 border-b border-outline bg-transparent py-3 px-0 text-on-surface focus:border-primary focus:ring-0 focus:outline-none outline-none transition-colors"
                                />
                            </div>
                            <div class="relative">
                                <input
                                    id="phone"
                                    v-model="form.phone"
                                    type="tel"
                                    placeholder="Phone Number"
                                    autocomplete="off"
                                    class="block w-full border-0 border-b border-outline bg-transparent py-3 px-0 text-on-surface focus:border-primary focus:ring-0 focus:outline-none outline-none transition-colors"
                                />
                            </div>
                            <div class="relative">
                                <input
                                    id="date"
                                    v-model="form.event_date"
                                    type="text"
                                    placeholder="Event Date"
                                    autocomplete="off"
                                    class="block w-full border-0 border-b border-outline bg-transparent py-3 px-0 text-on-surface focus:border-primary focus:ring-0 focus:outline-none outline-none transition-colors"
                                />
                            </div>
                        </div>

                        <div class="relative">
                            <label for="type" class="block font-sans text-xs uppercase tracking-widest text-primary mb-2">Service Category</label>
                            <select
                                id="type"
                                v-model="form.event_type"
                                class="block w-full border-0 border-b border-outline bg-transparent py-3 px-0 text-on-surface focus:border-primary focus:ring-0 focus:outline-none outline-none transition-colors"
                            >
                                <option value="" disabled>Select Event Type</option>
                                <option value="cinematic">Cinematic Feature</option>
                                <option value="editorial">Editorial Stills</option>
                                <option value="documentary">Documentary</option>
                                <option value="commercial">Commercial</option>
                            </select>
                        </div>

                        <div class="relative">
                            <textarea
                                id="vision"
                                v-model="form.vision"
                                rows="4"
                                placeholder="Your Creative Vision"
                                autocomplete="off"
                                class="block w-full border-0 border-b border-outline bg-transparent py-3 px-0 text-on-surface focus:border-primary focus:ring-0 focus:outline-none outline-none transition-colors resize-none"
                            ></textarea>
                        </div>

                        <button
                            type="submit"
                            :disabled="form.processing || loading"
                            class="w-full py-5 bg-primary text-white font-sans font-bold uppercase tracking-widest text-sm rounded hover:bg-primary-dark transition-all duration-500 disabled:opacity-50 flex items-center justify-center gap-3"
                        >
                            <svg v-if="form.processing || loading" class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                            </svg>
                            {{ form.processing || loading ? 'Sending...' : 'Send Message' }}
                        </button>
                    </form>
                </section>

                <section class="space-y-12 lg:pl-12">
                    <div class="p-8 bg-surface-dim border-l-4 border-primary/40 group hover:bg-surface-container transition-colors">
                        <div class="flex items-center gap-4 mb-4">
                            <span class="material-symbols-outlined text-primary text-3xl">chat</span>
                            <h3 class="font-sans uppercase tracking-widest text-sm text-on-surface">Direct Inquiry</h3>
                        </div>
                        <p class="text-on-surface-variant text-sm leading-relaxed mb-6">For immediate creative consultation, connect via WhatsApp for a priority response.</p>
                        <a
                            href="https://wa.me/1234567890"
                            target="_blank"
                            class="inline-flex items-center gap-2 text-primary text-xs uppercase font-bold tracking-widest hover:gap-4 transition-all duration-300"
                        >
                            Chat with us <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </a>
                    </div>

                    <div class="space-y-8 px-2">
                        <div class="flex items-start gap-6">
                            <span class="material-symbols-outlined text-on-surface-muted mt-1">mail</span>
                            <div>
                                <p class="text-xs uppercase tracking-widest text-on-surface-variant font-sans mb-1">Email</p>
                                <a href="mailto:studio@afobaino.com" class="text-lg font-headline italic hover:text-primary transition-colors">studio@afobaino.com</a>
                            </div>
                        </div>
                        <div class="flex items-start gap-6">
                            <span class="material-symbols-outlined text-on-surface-muted mt-1">location_on</span>
                            <div>
                                <p class="text-xs uppercase tracking-widest text-on-surface-variant font-sans mb-1">Studio</p>
                                <address class="text-lg font-headline italic leading-snug">Cottage 8, Moyvalley Hotel<br>Balyna Estate, Co. Kildare<br>Dublin, Ireland<br>Co. Kildare, W91 TF10</address>
                            </div>
                        </div>
                    </div>

                    <div class="aspect-square w-full bg-surface-container overflow-hidden relative group">
                        <img
                            src="https://res.cloudinary.com/dtetfimeq/image/upload/v1776459698/afobaino-films/gallery/afobaino-07.jpg"
                            alt="Studio location map"
                            class="w-full h-full object-cover grayscale opacity-60 group-hover:scale-105 transition-transform duration-1000"
                        />
                        <div class="absolute inset-0 bg-black/30"></div>
                        <div class="absolute bottom-6 left-6 p-4 bg-white/80 backdrop-blur-md">
                            <p class="text-[10px] font-sans uppercase tracking-widest text-primary">Headquarters</p>
                            <p class="text-xs tracking-tight text-on-surface">Dublin, Ireland</p>
                        </div>
                    </div>
                </section>
            </div>
        </main>



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
    </div>
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