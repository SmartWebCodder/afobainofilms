<script setup>
import { ref } from 'vue';

const form = ref({
    name: '',
    email: '',
    phone: '',
    date: '',
    type: '',
    vision: '',
});

const faqs = [
    { question: 'Do you travel for destination films?', open: false },
    { question: 'What is the typical turnaround for an editorial edit?', open: false },
    { question: 'How many cinematographers are on set?', open: false },
    { question: 'Do we receive the raw footage?', open: false },
];

function toggleFaq(index) {
    faqs[index].open = !faqs[index].open;
}

function submitForm() {
    // will be connected to backend later
}
</script>

<template>
    <div>
        <header class="relative h-102.25 flex items-center justify-center overflow-hidden bg-surface-dim">
            <div class="relative z-10 text-center px-6">
                <h1 class="text-4xl md:text-6xl font-headline italic tracking-tight text-on-surface">Start Your Story With Us</h1>
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

                    <form class="space-y-12" @submit.prevent="submitForm">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-12">
                            <div class="relative">
                                <input
                                    id="name"
                                    v-model="form.name"
                                    type="text"
                                    placeholder=" "
                                    class="peer block w-full border-0 border-b border-outline bg-transparent py-3 px-0 text-on-surface focus:border-primary focus:ring-0 transition-colors placeholder-transparent"
                                />
                                <label
                                    for="name"
                                    class="absolute top-3 -z-10 origin-left -translate-y-6 scale-75 transform font-sans text-sm uppercase tracking-widest text-on-surface-variant duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:text-primary"
                                >
                                    Full Name
                                </label>
                            </div>
                            <div class="relative">
                                <input
                                    id="email"
                                    v-model="form.email"
                                    type="email"
                                    placeholder=" "
                                    class="peer block w-full border-0 border-b border-outline bg-transparent py-3 px-0 text-on-surface focus:border-primary focus:ring-0 transition-colors placeholder-transparent"
                                />
                                <label
                                    for="email"
                                    class="absolute top-3 -z-10 origin-left -translate-y-6 scale-75 transform font-sans text-sm uppercase tracking-widest text-on-surface-variant duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:text-primary"
                                >
                                    Email Address
                                </label>
                            </div>
                            <div class="relative">
                                <input
                                    id="phone"
                                    v-model="form.phone"
                                    type="tel"
                                    placeholder=" "
                                    class="peer block w-full border-0 border-b border-outline bg-transparent py-3 px-0 text-on-surface focus:border-primary focus:ring-0 transition-colors placeholder-transparent"
                                />
                                <label
                                    for="phone"
                                    class="absolute top-3 -z-10 origin-left -translate-y-6 scale-75 transform font-sans text-sm uppercase tracking-widest text-on-surface-variant duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:text-primary"
                                >
                                    Phone Number
                                </label>
                            </div>
                            <div class="relative">
                                <input
                                    id="date"
                                    v-model="form.date"
                                    type="text"
                                    placeholder=" "
                                    class="peer block w-full border-0 border-b border-outline bg-transparent py-3 px-0 text-on-surface focus:border-primary focus:ring-0 transition-colors placeholder-transparent"
                                />
                                <label
                                    for="date"
                                    class="absolute top-3 -z-10 origin-left -translate-y-6 scale-75 transform font-sans text-sm uppercase tracking-widest text-on-surface-variant duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:text-primary"
                                >
                                    Event Date
                                </label>
                            </div>
                        </div>

                        <div class="relative">
                            <label for="type" class="block font-sans text-xs uppercase tracking-widest text-primary mb-2">Service Category</label>
                            <select
                                id="type"
                                v-model="form.type"
                                class="block w-full border-0 border-b border-outline bg-transparent py-3 px-0 text-on-surface focus:border-primary focus:ring-0 transition-colors"
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
                                placeholder=" "
                                class="peer block w-full border-0 border-b border-outline bg-transparent py-3 px-0 text-on-surface focus:border-primary focus:ring-0 transition-colors placeholder-transparent resize-none"
                            ></textarea>
                            <label
                                for="vision"
                                class="absolute top-3 -z-10 origin-left -translate-y-6 scale-75 transform font-sans text-sm uppercase tracking-widest text-on-surface-variant duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:text-primary"
                            >
                                Your Creative Vision
                            </label>
                        </div>

                        <button
                            type="submit"
                            class="w-full py-5 bg-primary text-white font-sans font-bold uppercase tracking-widest text-sm rounded hover:bg-primary-dark transition-all duration-500"
                        >
                            Send Message
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
                                <address class="text-lg font-headline italic leading-snug">Lagos, Nigeria</address>
                            </div>
                        </div>
                    </div>

                    <div class="aspect-square w-full bg-surface-container overflow-hidden relative group">
                        <img
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuDZtdRQtO1a8Gz5nw6fB-ATnQRWSO8M8eysv_9JZB9jdKDmjNSbBb_6DAuowkcz4F6RI3LyOs1KTB07wHL5eReU-gW5BijyM8qeVAoDo9_jrG4FD80xM2XcwxH-Ts1dtDsouMposQlT-Ewl7jljkaPn8qqt_CbDEBMcv9-7ZmIgT7R8YAT0V8YLcNCNZy6eAHg7ZZCVfKxCFBvZXiCGFf5nPzNm6ICWLn2nOMCoXPZSy-dDjm0-riIdOpboOG9DYR9bFGzt1qMrfMg"
                            alt="Studio location map"
                            class="w-full h-full object-cover grayscale opacity-60 group-hover:scale-105 transition-transform duration-1000"
                        />
                        <div class="absolute inset-0 bg-black/30"></div>
                        <div class="absolute bottom-6 left-6 p-4 bg-white/80 backdrop-blur-md">
                            <p class="text-[10px] font-sans uppercase tracking-widest text-primary">Headquarters</p>
                            <p class="text-xs tracking-tight text-on-surface">Lagos, Nigeria</p>
                        </div>
                    </div>
                </section>
            </div>
        </main>

        <section class="bg-surface-dim py-24 md:py-32">
            <div class="max-w-3xl mx-auto px-6">
                <div class="text-center mb-20">
                    <span class="font-sans text-xs uppercase tracking-[0.3em] text-primary">Process</span>
                    <h2 class="text-4xl font-headline mt-4">Questions of Craft</h2>
                </div>
                <div class="space-y-0">
                    <div
                        v-for="(faq, index) in faqs"
                        :key="index"
                        class="py-8 group cursor-pointer"
                        :class="index < faqs.length - 1 ? 'border-b border-outline' : ''"
                        @click="toggleFaq(index)"
                    >
                        <div class="flex justify-between items-center gap-8">
                            <h4 class="text-lg font-headline italic text-on-surface group-hover:text-primary transition-colors">{{ faq.question }}</h4>
                            <span
                                class="material-symbols-outlined text-primary transition-transform duration-300"
                                :class="faq.open ? 'rotate-45' : ''"
                            >
                                add
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
