<script setup>
import { ref, onMounted, onUnmounted, computed } from 'vue';

const props = defineProps({
    testimonials: { type: Array, default: () => [] },
});

const current = ref(0);
let timer = null;

const hasMultiple = computed(() => props.testimonials.length > 1);

function next() {
    current.value = (current.value + 1) % props.testimonials.length;
}

function prev() {
    current.value = (current.value - 1 + props.testimonials.length) % props.testimonials.length;
}

function startAutoScroll() {
    if (!hasMultiple.value) return;
    timer = setInterval(next, 6000);
}

function stopAutoScroll() {
    clearInterval(timer);
}

onMounted(startAutoScroll);
onUnmounted(stopAutoScroll);
</script>

<template>
    <section v-if="testimonials.length" class="py-24 md:py-32 px-6 md:px-12 bg-surface-container">
        <div class="max-w-4xl mx-auto text-center relative">
            <span class="material-symbols-outlined text-primary text-6xl mb-8" style="font-variation-settings: 'FILL' 1;">
                format_quote
            </span>

            <div class="relative overflow-hidden">
                <transition name="fade" mode="out-in">
                    <blockquote :key="current" class="font-headline italic text-lg md:text-2xl text-on-surface leading-relaxed mb-12">
                        "{{ testimonials[current].quote }}"
                    </blockquote>
                </transition>
            </div>

            <transition name="fade" mode="out-in">
                <div :key="current" class="space-y-2">
                    <p class="font-sans text-primary uppercase tracking-[0.3em] text-xs font-bold">{{ testimonials[current].client_name }}</p>
                    <p v-if="testimonials[current].location" class="font-serif text-on-surface-variant italic text-sm">{{ testimonials[current].location }}</p>
                </div>
            </transition>

            <div v-if="hasMultiple" class="mt-10 flex items-center justify-center gap-4">
                <button @click="prev(); stopAutoScroll(); startAutoScroll();" class="p-2 text-on-surface-variant hover:text-primary transition-colors">
                    <span class="material-symbols-outlined">chevron_left</span>
                </button>
                <div class="flex gap-2">
                    <button
                        v-for="(_, i) in testimonials"
                        :key="i"
                        @click="current = i; stopAutoScroll(); startAutoScroll();"
                        class="w-2 h-2 rounded-full transition-colors"
                        :class="i === current ? 'bg-primary' : 'bg-on-surface-muted/30'"
                    />
                </div>
                <button @click="next(); stopAutoScroll(); startAutoScroll();" class="p-2 text-on-surface-variant hover:text-primary transition-colors">
                    <span class="material-symbols-outlined">chevron_right</span>
                </button>
            </div>
        </div>
    </section>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.4s ease;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
