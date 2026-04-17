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

const submitted = ref(false);

const faqs = ref([
    { question: 'Do you travel for destination films?', answer: 'Absolutely. We have filmed across multiple continents and love capturing stories in breathtaking locations. Travel fees are included in our destination packages.', open: false },
    { question: 'What is the typical turnaround for an editorial edit?', answer: 'Our standard delivery is 8-12 weeks for a cinematic wedding film. Highlight reels are typically delivered within 4-6 weeks. Rush delivery is available upon request.', open: false },
    { question: 'How many cinematographers are on set?', answer: 'Our standard packages include two cinematographers to ensure comprehensive coverage. Larger events may include three or more depending on the scope of the production.', open: false },
    { question: 'Do we receive the raw footage?', answer: 'Raw footage is available as an add-on. We provide all final edited deliverables in 4K resolution, along with a curated selection of behind-the-scenes moments.', open: false },
]);

function toggleFaq(index) {
    faqs.value[index].open = !faqs.value[index].open;
}

function submitForm() {
    form.post('/contact', {
        preserveScroll: true,
        onSuccess: () => {
            submitted.value = true;
            form.reset();
        },
    });
}
</script>

<template>
    <div>
        <header class="relative h-102.25 flex items-center justify-center overflow-hidden">
            <img
                src="https://lh3.googleusercontent.com/aida-public/AB6AXuAlgEG__lTPaKgIjnUj40j2PC75HTfbgSAevEnwDhzmVN_Y1BT16fqgdG2lT35S21yIXCzIPbMywiqIRTW1EqoH-ZZK65SK8SAjE2fdp61yOHZ8ONqJAMLdv03DmVsB9UvIWZllU3CCC_sv4UmEvY2JZ7Ga0jdl1_jKgLW-3jYHPCi5UrcqLi6I8Lvh9L-nVz2jxYU6q0LQ0tXCA3EhKs5Cv34Tq4BZaIZFMkzKMM-_hW4_10Rwpwc61Gyctg4lQKfh1WfOIkxkSyI"
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
                            :disabled="form.processing"
                            class="w-full py-5 bg-primary text-white font-sans font-bold uppercase tracking-widest text-sm rounded hover:bg-primary-dark transition-all duration-500 disabled:opacity-50"
                        >
                            {{ form.processing ? 'Sending...' : 'Send Message' }}
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
                                class="material-symbols-outlined text-primary transition-transform duration-300 flex-shrink-0"
                                :class="faq.open ? 'rotate-45' : ''"
                            >
                                add
                            </span>
                        </div>
                        <div
                            class="overflow-hidden transition-all duration-300"
                            :style="{ maxHeight: faq.open ? '200px' : '0px', opacity: faq.open ? 1 : 0 }"
                        >
                            <p class="pt-4 text-on-surface-variant text-sm leading-relaxed">{{ faq.answer }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
