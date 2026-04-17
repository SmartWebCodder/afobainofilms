<script setup>
import { watch } from 'vue';

const props = defineProps({
    show: { type: Boolean, default: false },
    title: { type: String, default: 'Confirm Delete' },
    message: { type: String, default: 'Are you sure? This action cannot be undone.' },
    confirmLabel: { type: String, default: 'Delete' },
    cancelLabel: { type: String, default: 'Cancel' },
});

const emit = defineEmits(['confirm', 'cancel']);

watch(() => props.show, (val) => {
    document.body.style.overflow = val ? 'hidden' : '';
});
</script>

<template>
    <Teleport to="body">
        <Transition name="modal">
            <div v-if="show" class="fixed inset-0 z-[9999] flex items-center justify-center p-6" @click.self="emit('cancel')">
                <div class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>
                <div class="relative bg-white max-w-sm w-full p-10 text-center space-y-6 shadow-2xl">
                    <div class="mx-auto w-16 h-16 rounded-full bg-error/10 flex items-center justify-center">
                        <span class="material-symbols-outlined text-error text-3xl">warning</span>
                    </div>
                    <h3 class="text-2xl font-headline italic text-on-surface">{{ title }}</h3>
                    <p class="text-on-surface-variant text-sm leading-relaxed">{{ message }}</p>
                    <div class="flex items-center justify-center gap-3 pt-2">
                        <button
                            @click="emit('cancel')"
                            class="px-6 py-2.5 border border-outline text-on-surface-variant text-xs font-bold uppercase tracking-widest hover:text-on-surface hover:border-on-surface-muted transition-colors"
                        >
                            {{ cancelLabel }}
                        </button>
                        <button
                            @click="emit('confirm')"
                            class="px-6 py-2.5 bg-error text-white text-xs font-bold uppercase tracking-widest hover:bg-red-700 transition-colors"
                        >
                            {{ confirmLabel }}
                        </button>
                    </div>
                </div>
            </div>
        </Transition>
    </Teleport>
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
