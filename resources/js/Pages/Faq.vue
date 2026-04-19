<script setup>
import { ref } from 'vue';

const faqs = ref([
    { question: 'Do you travel for destination films?', answer: 'Absolutely. We have filmed across multiple continents and love capturing stories in breathtaking locations. Travel fees are included in our destination packages.', open: false },
    { question: 'What is the typical turnaround for an editorial edit?', answer: 'Our standard delivery is 8-12 weeks for a cinematic wedding film. Highlight reels are typically delivered within 4-6 weeks. Rush delivery is available upon request.', open: false },
    { question: 'How many cinematographers are on set?', answer: 'Our standard packages include two cinematographers to ensure comprehensive coverage. Larger events may include three or more depending on the scope of the production.', open: false },
    { question: 'Do we receive the raw footage?', answer: 'Raw footage is available as an add-on. We provide all final edited deliverables in 4K resolution, along with a curated selection of behind-the-scenes moments.', open: false },
]);

function toggleFaq(index) {
    faqs.value[index].open = !faqs.value[index].open;
}
</script>

<template>
    <div>
        <header class="relative h-102.25 flex items-center justify-center overflow-hidden">
            <img
                src="https://res.cloudinary.com/dtetfimeq/image/upload/v1776459698/afobaino-films/gallery/afobaino-07.jpg"
                alt="Cinematic setup"
                class="absolute inset-0 w-full h-full object-cover"
            />
            <div class="absolute inset-0 bg-black/50"></div>
            <div class="relative z-10 text-center px-6">
                <h1 class="text-4xl md:text-6xl font-headline italic tracking-tight text-white">Frequently Asked Questions</h1>
                <div class="mt-4 flex justify-center">
                    <div class="w-12 h-px bg-primary/40"></div>
                </div>
            </div>
        </header>

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
