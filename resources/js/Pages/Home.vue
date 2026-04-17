<script setup>
import HeroSection from '@/Components/Home/HeroSection.vue';
import FeaturedReel from '@/Components/Home/FeaturedReel.vue';
import PortfolioGrid from '@/Components/Home/PortfolioGrid.vue';
import AboutTeaser from '@/Components/Home/AboutTeaser.vue';
import TestimonialSection from '@/Components/Home/TestimonialSection.vue';
import ContactSection from '@/Components/Home/ContactSection.vue';
import InstagramStrip from '@/Components/Home/InstagramStrip.vue';

defineProps({
    testimonials: { type: Array, default: () => [] },
});
</script>

<template>
    <div>
        <HeroSection />
        <FeaturedReel />
        <PortfolioGrid />
        <AboutTeaser />
        <TestimonialSection :testimonials="testimonials" />
        <ContactSection />
        <InstagramStrip />
    </div>
</template>
