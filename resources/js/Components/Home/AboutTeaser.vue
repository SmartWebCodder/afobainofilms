<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <section class="py-24 md:py-32 px-6 md:px-12 bg-white">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row gap-20 items-center">
            <div class="w-full md:w-[40%] aspect-4/5 overflow-hidden">
                <img
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuBcrZ9CCMVI3hOtuxgcgTmav-F2ODoQlciAz8ur1RFrjUQ3J8Sb6CvMj7NFi2oYGp8ENFUkXBF9dUBjgahKnwguqx7ObKGHhovsE4HRl-MlMBFpfwI_OKCo0GaEla3kI2AHJyLXu8Kfj9UmTyHhAqSIFTq24qAxFYvgyBTqasYXUFoQ-854xc_id0RBehqfO1kY3WMHVtu8W0rkMGuJFAmDGlFmbbwIPx0pVr7bhbgQhPDQGfRrMyZtWPxBg_94P5Jj4XaHzcUgyw0"
                    alt="Filmmaker holding a vintage camera"
                    class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-1000"
                />
            </div>

            <div class="w-full md:w-[60%] text-left">
                <h2 class="font-headline text-4xl md:text-6xl text-on-surface mb-8 leading-tight">
                    Hey, I'm the Eye Behind <span class="italic text-primary">Afobaino Films</span>
                </h2>
                <p class="text-on-surface-variant text-xl leading-relaxed mb-10 font-light max-w-xl">
                    I believe that every frame should feel like a piece of art hanging in a gallery. My approach is less about directing and more about observing—capturing the raw, unscripted emotions that define who you are.
                </p>
                <Link href="/about" class="inline-flex items-center gap-4 group">
                    <span class="font-sans text-sm uppercase tracking-widest text-on-surface font-bold">Learn More</span>
                    <span class="w-12 h-px bg-primary group-hover:w-20 transition-all duration-500"></span>
                </Link>
            </div>
        </div>
    </section>
</template>
