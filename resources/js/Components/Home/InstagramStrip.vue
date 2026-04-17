<script setup>
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const instagramUrl = computed(() => usePage().props.socials?.instagram_url || 'https://www.instagram.com/afobainofilms/');

const images = [
    {
        src: 'https://lh3.googleusercontent.com/aida-public/AB6AXuDeS6HvMfR4UUt76Ig2rgPVgH045yIdeJI7xfbM_rq2ooASzaBVdy4DMYJfytDSvgY1vaXCvDyYjv-KLbke4zo8ABj9YTxOxHboPQNULcBX9WwS2mtqbdSEVfoiVEWMb8pnE3tDjz_U2CIwAPv3Lm20cOMUEOO3viu3ZX-tEWZnApTSnc8RMC0vIGrbuMrB-H8xYUQTOkakh1krW1m1LTUXpnKbf_ohlX_OCQtNYV96VWsrvcnf1dg8_bnhRhRURZBKkpfIB0Gfdmw',
        alt: 'Delicate lace wedding dress details',
    },
    {
        src: 'https://lh3.googleusercontent.com/aida-public/AB6AXuCSEc5BLspiPV-jGxw_jVHdp9qNwLRHGKlzDRGCF_7quzFy1DP2lI2NHT_m7TwOAtwHGeyoQFK_w6CIQKQgUv_n-bYFZSuxCgkjWE0EpKDGvbE2imyoskYIPlqJ7eHzbMaBMyl_0Tw_680mmOmTeqpMmIR1onGCquP9UInHgjfCDoaC48en_DQQorDJ39msEij3jfSSqVigp_M7XxFOA_B0wt-S3v6qGmb7HEllaveO0chMmikUXA5UhS2vTdXfH0mb-tCBiQuLln4',
        alt: 'Wedding rings on an old book',
    },
    {
        src: 'https://lh3.googleusercontent.com/aida-public/AB6AXuDsk-u5S2KaAn94s0tFeCwKh28Bzy8VUege8aE-4MhTZktWWWilO02QGJUm3Kq-gX7fq42MTgexie7fdjf9PifDOAKdrm7lcgYfRXABgPPzCgCXThNGHFKiYwvRqQrlMzjXhz1kps1_66YemRV_-OMKgaaCUW8l5ZUKXukFvuHGzzpwthQy6tcFGQmmXthVskeoKegbj0PuYJfHhourGGZPASWyAYObWli0V-lgMhRlf5Yi2ZS8gc5-InUjJm9z06cAqPdXD6hkB50',
        alt: 'Wedding reception with glowing lanterns',
    },
    {
        src: 'https://lh3.googleusercontent.com/aida-public/AB6AXuAwYY4boO8WtH3NgwQ9B1MsuSYLrLHpQ_nUuxIZ9gg171GIM5-dX2uJyCCg5A5zxgSJH1aH_4weW4vU3tAxv9gTIbe2RXz4CvxDVAZXslGiCnY44rcElbMqqlpHNeIIyEwYz0dJiyE0bRN8it3mqoAoXkXG_BG-8ZRIVriY5VBUK-OcoosjwP8J4A8OEnz8lOYGYFzHXAf-kax2mZVz7DO16UpuryJ_xP13JyyztaXtjb1AE6reNJ75lHGll6CQYBE9FiahF5_1K5A',
        alt: 'Couple dancing in a grand ballroom',
    },
    {
        src: 'https://lh3.googleusercontent.com/aida-public/AB6AXuBj4U9OWU4YdivKoClfZbQbMa5LjWuaHFLHmaFikGsIH-YI246N5vVmJp0SFsJbLD_aR2gZ6FdTafE41cWOpElL_dlhASXbXTMkAi4TcT04qFN7ASjDdLUXe8CPwf1BcDPRAkrZH0_XnEPEhd8DQHCRN4_wQaT_0L6dnd3KPZ91QduTLCRG7ZTDJpUsOJzw19ZUi12w8ETC6vd4zV0KdxyvrNSogG88GQMxO85S0-7zQt_KZfSC0JhEgYsiXZV8L9vXgNx96PZKggI',
        alt: 'Groom fixing tie in mirror light',
    },
    {
        src: 'https://lh3.googleusercontent.com/aida-public/AB6AXuCVh88DwNd6Zmx0R1HhdRoY-3B1J8raixSfm-fJvA-Rmbk8DvvSuFN4I-SLIvSD8QPRqRl9nV-R5S7MXqidOiRpfsPxFP9jo3g9M6lI7Wb-6qT35tzWBGEEk6wAF5DXFQMiQ7kduqJj4yFyLzoziYuaurSLd_5ECWjhyt70R71e8hiScVhlzQRqhdBj_Uw8cfywfiwP65oQ4TDHguEtznSFMyEeKYXD4GADyYed-mxmID9wi-7eszDOQSwzfkm_itIbz8u1q3rF60c',
        alt: 'Wedding table with candles',
    },
];
</script>

<template>
    <section class="relative">
        <a :href="instagramUrl" target="_blank" rel="noopener" class="block">
            <div class="grid grid-cols-2 md:grid-cols-6 w-full">
                <div
                    v-for="img in images"
                    :key="img.alt"
                    class="aspect-square overflow-hidden relative group"
                >
                    <img
                        :src="img.src"
                        :alt="img.alt"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                    />
                    <div class="absolute inset-0 bg-primary/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                        <span class="material-symbols-outlined text-white">camera</span>
                    </div>
                </div>
            </div>
            <div class="absolute inset-0 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity duration-500 bg-black/40">
                <div class="text-center text-white">
                    <span class="material-symbols-outlined text-4xl mb-2">photo_camera</span>
                    <p class="font-sans text-xs uppercase tracking-[0.3em]">Follow us on Instagram</p>
                    <p class="font-headline text-lg mt-1">@afobainofilms</p>
                </div>
            </div>
        </a>
    </section>
</template>
