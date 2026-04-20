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
    <section class="py-24 md:py-32 px-6 md:px-12 bg-surface-dim">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-24 items-start">
                <div class="space-y-8">
                    <div class="space-y-4">
                        <span class="font-sans text-xs uppercase tracking-[0.3em] text-primary">Get in Touch</span>
                        <h2 class="text-4xl font-headline italic text-on-surface">Start Your Story</h2>
                        <p class="text-on-surface-variant leading-relaxed max-w-md">
                            Ready to create something extraordinary? Share your vision and let's craft a cinematic masterpiece together.
                        </p>
                    </div>

                    <div class="space-y-6 pt-4">
                        <div class="flex items-start gap-4">
                            <span class="material-symbols-outlined text-primary mt-0.5">mail</span>
                            <div>
                                <p class="text-xs uppercase tracking-widest text-on-surface-variant font-sans mb-1">Email</p>
                                <a href="mailto:studio@afobaino.com" class="text-lg font-headline italic hover:text-primary transition-colors">studio@afobaino.com</a>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <span class="material-symbols-outlined text-primary mt-0.5">chat</span>
                            <div>
                                <p class="text-xs uppercase tracking-widest text-on-surface-variant font-sans mb-1">WhatsApp</p>
                                <a href="https://wa.me/1234567890" target="_blank" class="text-lg font-headline italic hover:text-primary transition-colors">Chat with us</a>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <span class="material-symbols-outlined text-primary mt-0.5">location_on</span>
                            <div>
                                <p class="text-xs uppercase tracking-widest text-on-surface-variant font-sans mb-1">Studio</p>
                                <address class="text-lg font-headline italic not-italic">Cottage 8, Moyvalley Hotel<br>Balyna Estate, Co. Kildare<br>Dublin, Ireland<br>Co. Kildare, W91 TF10</address>
                            </div>
                        </div>
                    </div>
                </div>

                <form class="space-y-10" @submit.prevent="submit" autocomplete="off">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-10">
                        <div class="relative">
                            <input
                                v-model="form.name"
                                type="text"
                                placeholder="Full Name"
                                autocomplete="off"
                                class="peer block w-full border-0 border-b border-outline bg-transparent py-3 px-0 text-on-surface focus:border-primary focus:ring-0 focus:outline-none outline-none transition-colors"
                            />
                            <p v-if="form.errors.name" class="text-error text-xs mt-1">{{ form.errors.name }}</p>
                        </div>
                        <div class="relative">
                            <input
                                v-model="form.email"
                                type="email"
                                placeholder="Email Address"
                                autocomplete="off"
                                class="peer block w-full border-0 border-b border-outline bg-transparent py-3 px-0 text-on-surface focus:border-primary focus:ring-0 focus:outline-none outline-none transition-colors"
                            />
                            <p v-if="form.errors.email" class="text-error text-xs mt-1">{{ form.errors.email }}</p>
                        </div>
                        <div class="relative">
                            <input
                                v-model="form.phone"
                                type="tel"
                                placeholder="Phone Number"
                                autocomplete="off"
                                class="peer block w-full border-0 border-b border-outline bg-transparent py-3 px-0 text-on-surface focus:border-primary focus:ring-0 focus:outline-none outline-none transition-colors"
                            />
                        </div>
                        <div class="relative">
                            <input
                                v-model="form.event_date"
                                type="text"
                                placeholder="Event Date"
                                autocomplete="off"
                                class="peer block w-full border-0 border-b border-outline bg-transparent py-3 px-0 text-on-surface focus:border-primary focus:ring-0 focus:outline-none outline-none transition-colors"
                            />
                        </div>
                    </div>

                    <div>
                        <label class="block font-sans text-xs uppercase tracking-widest text-primary mb-2">Service Category</label>
                        <select
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
                            v-model="form.vision"
                            rows="3"
                            placeholder="Your Creative Vision"
                            autocomplete="off"
                            class="block w-full border-0 border-b border-outline bg-transparent py-3 px-0 text-on-surface focus:border-primary focus:ring-0 focus:outline-none outline-none transition-colors resize-none"
                        ></textarea>
                    </div>

                    <button
                        type="submit"
                        :disabled="form.processing || loading"
                        class="w-full py-5 bg-primary text-white font-sans font-bold uppercase tracking-widest text-sm hover:bg-primary-dark transition-all duration-500 disabled:opacity-50 flex items-center justify-center gap-3"
                    >
                        <svg v-if="form.processing || loading" class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                        </svg>
                        {{ form.processing || loading ? 'Sending...' : 'Send Message' }}
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